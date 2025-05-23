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
      console.log(`📱 Nomor BOT: ${sock.user.id}`)
    }
  })

  sock.ev.on('creds.update', saveCreds)

  sock.ev.on('messages.upsert', async (m) => {
    const msg = m.messages[0]
    if (!msg.message || msg.key.fromMe) return

    const sender = msg.key.remoteJid
    const text = msg.message.conversation || msg.message.extendedTextMessage?.text || ''
    const pushName = msg.pushName || 'Pengguna'

    console.log('📨 Pesan dari:', sender)
    console.log('💬 Isi pesan:', text)

    const greetingKeywords = ['hi', 'hai', 'halo', 'hallo', 'hey', 'assalamualaikum', 'pagi', 'selamat pagi', 'selamat siang', 'selamat sore', 'selamat malam']

    if (greetingKeywords.includes(text.toLowerCase())) {
      await sock.sendMessage(sender, {
        text: `👋 Hai! Ada yang bisa kami bantu?\n\n📋 *Daftar Perintah BOT SKPI* 📋\n\n- 👋 *halo*        : Menyapa bot dan mendapatkan balasan sapaan.\n- ℹ *info*         : Menampilkan informasi singkat tentang BOT SKPI.\n- 🆘 *bantuan/help* : Menampilkan daftar perintah yang bisa kamu gunakan.\n- 🕒 *waktu*        : Menampilkan waktu dan tanggal saat ini.\n- 📍 *lokasi*       : Mengirim lokasi Universitas Advent Indonesia.\n- 📱 *device*       : Menampilkan info perangkat kamu.\n\nSelamat menggunakan! 😊`
      })
    } else if (['help', 'bantuan'].includes(text.toLowerCase())) {
      await sock.sendMessage(sender, {
        text: `🆘 *Bantuan BOT SKPI*\n\nGunakan perintah berikut:\n\n✅ *info* - Informasi tentang SKPI UNAI\n🕒 *waktu* - Tampilkan waktu dan tanggal saat ini\n📍 *lokasi* - Lokasi UNAI\n📚 *skpi* - Penjelasan tentang apa itu SKPI\n✍️ *kontak* - Hubungi admin atau WR III\n📱 *device* - Info perangkat yang kamu gunakan\n\nKetik salah satu perintah di atas untuk mulai.`
      })
    } else if (text.toLowerCase() === 'info') {
      await sock.sendMessage(sender, {
        text: `ℹ *Informasi BOT SKPI*\n\nBot ini dibuat untuk membantu mahasiswa Universitas Advent Indonesia dalam mengakses informasi terkait SKPI (Surat Keterangan Pendamping Ijazah).\n\nSKPI membantu mahasiswa untuk menunjukkan capaian non-akademik yang bisa memperkuat nilai ijazah.`
      })
    } else if (text.toLowerCase() === 'waktu') {
      const waktu = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' })
      await sock.sendMessage(sender, { text: `🕒 Waktu saat ini: ${waktu}` })
    } else if (text.toLowerCase() === 'lokasi') {
      await sock.sendMessage(sender, {
        location: {
          degreesLatitude: -6.857,
          degreesLongitude: 107.6181,
          name: "Universitas Advent Indonesia",
          address: "Jl. Kolonel Masturi No.288, Parongpong, Kab. Bandung Barat"
        }
      })
      await sock.sendMessage(sender, {
        text: `📍 *Google Maps UNAI:*\nhttps://maps.app.goo.gl/9yTyGfBL4TDSfKqv7`
      })
    } else if (text.toLowerCase() === 'kontak') {
      await sock.sendMessage(sender, {
        text: "📞 Hubungi langsung:\n",
        footer: 'BOT SKPI',
        buttons: [
          { buttonId: 'chat_wakil_rektor', buttonText: { displayText: 'Chat Sir. Yunus Elon' }, type: 1 },
          { buttonId: 'email_wakil_rektor', buttonText: { displayText: 'Kirim Email' }, type: 1 }
        ],
        headerType: 1
      })
    } else if (text === 'chat_wakil_rektor') {
      await sock.sendMessage(sender, { text: 'https://wa.me/6281313361884' })
    } else if (text === 'email_wakil_rektor') {
      await sock.sendMessage(sender, { text: 'mailto:yunus.elon@unai.edu' })
    } else if (text.toLowerCase() === 'skpi') {
      await sock.sendMessage(sender, {
        text: `📚 *Apa itu SKPI?*\n\nSKPI (Surat Keterangan Pendamping Ijazah) adalah dokumen resmi yang menjelaskan capaian kompetensi lulusan secara lengkap, baik akademik maupun non-akademik.\n\nDengan SKPI, mahasiswa bisa lebih mudah menunjukkan kemampuan mereka kepada dunia kerja.`
      })
    } else if (text.toLowerCase() === 'tips') {
      await sock.sendMessage(sender, {
        text: `💡 *Tips SKPI*\n\n- Ikut aktif dalam kegiatan organisasi dan pengembangan diri.\n- Rajin mendokumentasikan aktivitas dan prestasi.\n- Jaga integritas dan kedisiplinan.\n- Manfaatkan SKPI untuk memperkuat portofolio kerja.\n- Selalu update informasi tentang persyaratan SKPI.`
      })
    } else if (text.toLowerCase() === 'device') {
      await sock.sendMessage(sender, {
        text: `📱 Informasi perangkat kamu:\n\nNama kontak: ${pushName}\nNomor: ${sender.replace('@s.whatsapp.net', '')}\n\n(Info ini berdasarkan data WhatsApp yang kami terima)`
      })
    } else {
      await sock.sendMessage(sender, {
        text: `❓ Maaf, perintah tidak dikenali.\nKetik *help* untuk melihat daftar perintah.`
      })
    }
  })
}

startBot()
