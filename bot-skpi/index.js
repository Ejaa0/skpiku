const { default: makeWASocket, useSingleFileAuthState, DisconnectReason, fetchLatestBaileysVersion, makeInMemoryStore } = require("@whiskeysockets/baileys");
const { Boom } = require("@hapi/boom");
const { state, saveState } = useSingleFileAuthState('./auth.json');
const pino = require('pino');

const store = makeInMemoryStore({ logger: pino().child({ level: 'silent', stream: 'store' }) });

async function startBot() {
    const { version, isLatest } = await fetchLatestBaileysVersion();
    console.log(`Using WA version v${version.join('.')}, isLatest: ${isLatest}`);

    const sock = makeWASocket({
        logger: pino({ level: 'silent' }),
        printQRInTerminal: true,
        auth: state,
        version
    });

    store.bind(sock.ev);

    sock.ev.on('connection.update', (update) => {
        const { connection, lastDisconnect } = update;
        if(connection === 'close') {
            const shouldReconnect = (lastDisconnect.error)?.output?.statusCode !== DisconnectReason.loggedOut;
            console.log('connection closed due to', lastDisconnect.error, ', reconnecting:', shouldReconnect);
            if(shouldReconnect) {
                startBot();
            } else {
                console.log('Connection closed. You are logged out.');
            }
        } else if(connection === 'open') {
            console.log('Connected to WhatsApp');
        }
    });

    sock.ev.on('messages.upsert', async (m) => {
        const msg = m.messages[0];
        if(!msg.message || msg.key.fromMe) return;

        const from = msg.key.remoteJid;
        const type = Object.keys(msg.message)[0];
        let text = '';

        if(type === 'conversation') {
            text = msg.message.conversation;
        } else if(type === 'extendedTextMessage') {
            text = msg.message.extendedTextMessage.text;
        }

        if(!text) return;

        const lowerText = text.toLowerCase();

        // Respon sederhana
        let reply = 'Maaf, perintah tidak dikenali. Ketik "menu" untuk daftar perintah.';

        if(lowerText === 'halo') {
            reply = 'Halo! Selamat datang di BOT SKPI.';
        } else if(lowerText === 'menu') {
            reply = 'Daftar perintah:\n' +
                    '1. halo\n' +
                    '2. cek poin [NIM]\n' +
                    '3. kuis skpi\n' +
                    'Ketik perintah sesuai format.';
        } else if(lowerText.startsWith('cek poin ')) {
            const nim = text.substring(9).trim();
            // Data poin hardcoded
            const dataPoin = {
                '12345678': 1250,
                '87654321': 900,
                '11223344': 1100
            };
            if(nim in dataPoin) {
                reply = `Poin SKPI untuk NIM ${nim} adalah: ${dataPoin[nim]} poin.`;
            } else {
                reply = `Data poin untuk NIM ${nim} tidak ditemukan.`;
            }
        } else if(lowerText === 'kuis skpi') {
            reply = 'Kuis SKPI:\n1. Apa singkatan SKPI?\nA. Surat Keterangan Pendamping Ijazah\nB. Sistem Komputer dan Proses Informatika\nJawab dengan "jawab A" atau "jawab B".';
        } else if(lowerText.startsWith('jawab ')) {
            const answer = text.substring(6).trim().toUpperCase();
            if(answer === 'A') {
                reply = 'Benar! SKPI = Surat Keterangan Pendamping Ijazah.';
            } else if(answer === 'B') {
                reply = 'Salah. Coba lagi ya!';
            } else {
                reply = 'Jawaban tidak valid. Ketik "kuis skpi" untuk memulai kuis.';
            }
        }

        await sock.sendMessage(from, { text: reply });
    });

    sock.ev.on('creds.update', saveState);
}

startBot();
