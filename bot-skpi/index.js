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
      console.log('📱 Nomor BOT:', sock.user.id)
    }
  })

  sock.ev.on('creds.update', saveCreds)

  sock.ev.on('messages.upsert', async (m) => {
    const msg = m.messages[0]
    if (!msg.message || msg.key.fromMe) return

    const sender = msg.key.remoteJid
    const text = msg.message.conversation || msg.message.extendedTextMessage?.text

    console.log('📨 Pesan dari:', sender)
    console.log('💬 Isi pesan:', text)

    if (!text) return

    const lowerText = text.toLowerCase()

    if (lowerText === 'halo') {
      await sock.sendMessage(sender, { text: 'Halo juga! Ini BOT SKPI 👋' })
    }

    if (lowerText.includes('poin saya')) {
      await sock.sendMessage(sender, {
        text: 'Poin kamu sedang dihitung dari sistem Laravel. Tunggu yaa! 😎'
      })
    }
  })
}

startBot()
