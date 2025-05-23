import fs from 'fs'
import baileys from '@whiskeysockets/baileys'
import qrcode from 'qrcode-terminal'
import P from 'pino'

const {
  makeWASocket,
  useMultiFileAuthState,
  DisconnectReason,
  fetchLatestBaileysVersion
} = baileys

async function startBot() {
  const { state, saveCreds } = await useMultiFileAuthState('auth_info_baileys')
  const { version } = await fetchLatestBaileysVersion()

  const sock = makeWASocket({
    version,
    auth: state,
    logger: P({ level: 'silent' })
  })

  // Simpan nomor yang sudah pernah chat supaya bot gak spam kirim bantuan otomatis
  const usersSeen = new Set()

  sock.ev.on('connection.update', (update) => {
    const { connection, lastDisconnect, qr } = update

    if (qr) {
      qrcode.generate(qr, { small: true })
      console.log('📱 Silakan scan QR code dengan WhatsApp.')
    }

    if (connection === 'close') {
      const shouldReconnect = (lastDisconnect?.error)?.output?.statusCode !== DisconnectReason.loggedOut
      console.log('🔌 Koneksi terputus:', lastDisconnect?.error, 'Reconnect?', shouldReconnect)
      if (shouldReconnect) startBot()
      else console.log('❌ Tidak reconnect. Sudah logout.')
    } else if (connection === 'open') {
      console.log('✅ BOT SKPI sudah terhubung!')
    }
  })

  sock.ev.on('creds.update', saveCreds)

  sock.ev.on('messages.upsert', async (m) => {
    const msg = m.messages[0]
    if (!msg.message || msg.key.fromMe) return

    const sender = msg.key.remoteJid
    const text = msg.message.conversation || msg.message.extendedTextMessage?.text
    if (!text) return

    const lowerText = text.toLowerCase().trim()

    // Jika chat pertama kali, langsung kirim daftar perintah
    if (!usersSeen.has(sender)) {
      usersSeen.add(sender)
      await sock.sendMessage(sender, {
        text: `📋 *Daftar Perintah BOT SKPI* 📋

- 👋 *halo*        : Menyapa bot dan mendapatkan balasan sapaan.
- ℹ️ *info*         : Menampilkan informasi singkat tentang BOT SKPI.
- 🆘 *bantuan/help* : Menampilkan daftar perintah yang bisa kamu gunakan.
- 🕒 *waktu*        : Menampilkan waktu dan tanggal saat ini.
- 📍 *lokasi*       : Mengirim lokasi Universitas Advent Indonesia.

Silakan ketik perintah di atas ya!`
      })
      return // biar gak lanjut ke balasan lain saat pertama kali
    }

    // Array kata sapaan
    const greetings = ["hi", "hai", "halo", "hallo", "hey", "assalamualaikum", "pagi", "selamat pagi", "selamat siang", "selamat sore", "selamat malam"]

    if (greetings.includes(lowerText)) {
      await sock.sendMessage(sender, {
        text: `👋 Hai, ada yang bisa kami bantu? 😊

📋 *Daftar Perintah BOT SKPI* 📋
- 👋 *halo*        : Menyapa bot dan mendapatkan balasan sapaan.
- ℹ️ *info*         : Menampilkan informasi singkat tentang BOT SKPI.
- 🆘 *bantuan/help* : Menampilkan daftar perintah yang bisa kamu gunakan.
- 🕒 *waktu*        : Menampilkan waktu dan tanggal saat ini.
- 📍 *lokasi*       : Mengirim lokasi Universitas Advent Indonesia.
`
      })
      return
    }

    if (lowerText === 'info') {
      await sock.sendMessage(sender, {
        text: `ℹ️ *Info BOT SKPI*\nBOT ini membantu kamu mendapatkan informasi terkait SKPI Universitas Advent Indonesia.`
      })
      return
    }

    if (lowerText === 'bantuan' || lowerText === 'help') {
      await sock.sendMessage(sender, {
        text: `🆘 *Daftar Perintah*\n\n- 👋 halo\n- ℹ️ info\n- 🆘 bantuan/help\n- 🕒 waktu\n- 📍 lokasi`
      })
      return
    }

    if (lowerText === 'waktu') {
      const now = new Date()
      await sock.sendMessage(sender, {
        text: `🕒 Waktu saat ini: ${now.toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' })}`
      })
      return
    }

    if (lowerText === 'lokasi') {
      await sock.sendMessage(sender, {
        location: {
          degreesLatitude: -6.914744,
          degreesLongitude: 107.609810,
          name: "Universitas Advent Indonesia",
          address: "Jalan Terusan Ahmad Yani No. 70, Bandung"
        }
      })
      return
    }

    // Balasan default jika perintah tidak dikenal
    await sock.sendMessage(sender, {
      text: `Maaf, perintah tidak dikenali. Ketik *bantuan* atau *help* untuk daftar perintah.`
    })
  })
}

startBot()
