<template>
  <div class="w-full min-h-screen font-lato bg-linear-to-br from-[#0b1a0b] via-[#1a2e1a] to-[#0f2618]">
    
    <!-- Particles -->
    <div class="fixed inset-0 pointer-events-none z-20" ref="particlesContainer"></div>

    <!-- Envelope Section -->
    <div id="envelope-wrapper" ref="envelopeWrapper" class="z-0 fixed inset-0 bg-linear-to-br from-[#0b1a0b] via-[#1a2e1a] to-[#0f2618] flex flex-col justify-center items-center transition-all duration-1000" style="perspective: 3000px;">

      <div 
        class="envelope relative w-11/12 max-w-[420px] aspect-[4/3] bg-[#faf6f1] rounded-lg shadow-[0_0_40px_rgba(212,175,55,0.2),0_20px_60px_rgba(0,0,0,0.4)] cursor-pointer"
        style="background-image: url('image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27100%27 height=%27100%27 viewBox=%270 0 100 100%27%3E%3Cfilter id=%27noise%27%3E%3CfeTurbulence type=%27fractalNoise%27 baseFrequency=%270.8%27 numOctaves=%274%27 stitchTiles=%27stitch%27/%3E%3C/filter%3E%3Crect width=%27100%27 height=%27100%27 filter=%27url(%23noise)%27 opacity=%270.08%27/%3E%3C/svg%3E'); transform-style: preserve-3d;"
        ref="mainEnvelope" 
        @click="openEnvelope"
      >
        <div class="absolute inset-0 bg-[#f0e8dc] border border-[#e8d5a0] z-[1] rounded-lg"></div>
        <div class="absolute top-0 left-0 w-full h-3/5 bg-linear-to-b from-[#f0e8dc] to-[#faf6f1]" style="clip-path: polygon(0 0, 100% 0, 50% 100%); transform-origin: top center; z-index: 8; transition: transform 1.2s cubic-bezier(0.34, 1.56, 0.64, 1); background-image: url('image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27100%27 height=%27100%27 viewBox=%270 0 100 100%27%3E%3Cfilter id=%27noise%27%3E%3CfeTurbulence type=%27fractalNoise%27 baseFrequency=%270.8%27 numOctaves=%274%27 stitchTiles=%27stitch%27/%3E%3C/filter%3E%3Crect width=%27100%27 height=%27100%27 filter=%27url(%23noise)%27 opacity=%270.08%27/%3E%3C/svg%3E');"></div>
        <div class="absolute top-[55%] left-1/2 w-[70px] h-[70px] bg-linear-to-br from-[#f5e6c8] via-[#d4af37] to-[#b8941f] rounded-full z-[9] flex items-center justify-center" style="transform: translate(-50%, -50%); box-shadow: 0 8px 25px rgba(0,0,0,0.4), inset 0 2px 10px rgba(255,255,255,0.4); border: 3px solid rgba(255,255,255,0.4); transition: 0.6s ease;">
          <i class="fas fa-heart text-[#8b6914] text-[1.8rem]" style="text-shadow: 0 1px 3px rgba(255,255,255,0.5); filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));"></i>
        </div>
        <div class="absolute bottom-[5%] left-[5%] w-[90%] h-[90%] bg-[#fffefb] rounded-lg z-[3] p-8 flex flex-col items-center justify-center text-center border border-[#e6d5c3]" style="background-image: url('image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27100%27 height=%27100%27 viewBox=%270 0 100 100%27%3E%3Cfilter id=%27noise%27%3E%3CfeTurbulence type=%27fractalNoise%27 baseFrequency=%270.8%27 numOctaves=%274%27 stitchTiles=%27stitch%27/%3E%3C/filter%3E%3Crect width=%27100%27 height=%27100%27 filter=%27url(%23noise)%27 opacity=%270.08%27/%3E%3C/svg%3E'); transition: transform 1.5s cubic-bezier(0.34, 1, 0.64, 1);">
          <p class="font-dancing text-[1.3rem] text-[#9a7b35]" style="opacity: 0; transform: translateY(15px); transition: 0.8s;">
            Mutluluğumuza Davetlisiniz
          </p>
          <h1 class="font-playfair font-bold italic text-[2.4rem] my-[10px] bg-linear-to-r from-[#9a7b35] via-[#e8d5a0] to-[#c9a84c] bg-clip-text text-transparent animate-shine" style="background-size: 200% auto; opacity: 0; transform: translateY(15px); transition: 0.8s; animation: shine 3s linear infinite;">
            Hüma & Tuğcan
          </h1>
          <p class="font-bold text-[#9a7b35] tracking-[2px]" style="opacity: 0; transform: translateY(15px); transition: 0.8s;">
            02.05.2026
          </p>
        </div>
      </div>
      <p class="font-dancing text-[#c9a84c] mt-[30px] text-[1.2rem]" style="animation: hintBounce 2s infinite;">
        ✧ Açmak için dokunun ✧
      </p>
    </div>

    <!-- Main Content -->
    <div id="main-content" ref="mainContent" class="hidden opacity-0 transition-opacity duration-1000 z-0 relative">

      <!-- Header Section -->
      <header class="min-h-screen flex items-center justify-center py-12 z-30 relative">
        <div class="bg-[#f5f9f5] rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.4)] border-t-[5px] border-[#c9a84c] p-12 max-w-[850px] mx-auto opacity-100 transform translate-y-0 transition-all duration-700">
          <p class="font-dancing text-[1.8rem] text-[#9a7b35]">
            Nişan Törenimize Davetlisiniz
          </p>
          <h1 class="font-playfair font-bold italic text-5xl my-[15px] bg-linear-to-r from-[#9a7b35] via-[#e8d5a0] to-[#c9a84c] bg-clip-text text-transparent" style="background-size: 200% auto; animation: shine 3s linear infinite;">
            Hüma & Tuğcan
          </h1>
          <p class="font-bold text-[#2d6a4f]">
            02 MAYIS 2026 | CUMARTESİ
          </p>
          <div class="flex gap-2 justify-center mt-8 flex-wrap">
            <div class="bg-white px-4 py-3 rounded-xl border-2 border-[#c9a84c] min-w-[75px]">
              <span class="text-[1.8rem] font-bold text-[#2d6a4f] block">{{ String(countdown.days).padStart(2, '0') }}</span>
              <small>Gün</small>
            </div>
            <div class="bg-white px-4 py-3 rounded-xl border-2 border-[#c9a84c] min-w-[75px]">
              <span class="text-[1.8rem] font-bold text-[#2d6a4f] block">{{ String(countdown.hours).padStart(2, '0') }}</span>
              <small>Saat</small>
            </div>
            <div class="bg-white px-4 py-3 rounded-xl border-2 border-[#c9a84c] min-w-[75px]">
              <span class="text-[1.8rem] font-bold text-[#2d6a4f] block">{{ String(countdown.minutes).padStart(2, '0') }}</span>
              <small>Dakika</small>
            </div>
            <div class="bg-white px-4 py-3 rounded-xl border-2 border-[#c9a84c] min-w-[75px]">
              <span class="text-[1.8rem] font-bold text-[#2d6a4f] block">{{ String(countdown.seconds).padStart(2, '0') }}</span>
              <small>Saniye</small>
            </div>
          </div>
        </div>
      </header>

      <!-- Location Section -->
      <section id="mekan" class="py-12 px-6 max-w-[850px] mx-auto text-center">
        <div class="card bg-[#f5f9f5] rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.4)] border-t-[5px] border-[#c9a84c] p-12 mb-10 opacity-0 transform translate-y-[30px] transition-all duration-700">
          <i class="fas fa-map-marker-alt text-[2.5rem] text-[#2d6a4f] mb-2"></i>
          <h2 class="font-playfair mb-2">Polen Restoran</h2>
          
          <div class="bg-linear-to-br from-[#2d6a4f] to-[#40916c] border-[3px] border-[#c9a84c] rounded-[20px] p-[30px] mb-[10px] shadow-[0_10px_30px_rgba(0,0,0,0.3)] relative overflow-hidden">
            <div class="absolute -top-1/2 -right-1/2 w-[200%] h-[200%] bg-linear-radial from-[rgba(201,168,76,0.1)] to-transparent" style="animation: shimmer 5s infinite;"></div>
            
            <h3 class="font-playfair text-[1.8rem] text-white mb-[25px] flex items-center justify-center gap-3 relative z-10" style="text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
              <i class="fas fa-map-pin text-[#e8d5a0] text-[2rem]"></i>
              Tören Lokasyonu
            </h3>
            
            <div class="flex gap-4 my-[18px] text-white relative z-10 p-2 bg-[rgba(255,255,255,0.1)] rounded-[10px] transition-all hover:bg-[rgba(255,255,255,0.15)] hover:translate-x-1">
              <i class="fas fa-location-dot text-[#e8d5a0] text-[1.3rem] mt-1 min-w-[25px]"></i>
              <div class="text-left flex-1">
                <span class="font-bold block mb-1 text-[#e8d5a0]">Adres</span>
                <span class="text-[0.95rem]">Eğridere, Sarmaşık Sk. No: 20/A, Bornova/İzmir</span>
              </div>
            </div>
            
            <div class="flex gap-4 my-[18px] text-white relative z-10 p-2 bg-[rgba(255,255,255,0.1)] rounded-[10px] transition-all hover:bg-[rgba(255,255,255,0.15)] hover:translate-x-1">
              <i class="fas fa-clock text-[#e8d5a0] text-[1.3rem] mt-1 min-w-[25px]"></i>
              <div class="text-left flex-1">
                <span class="font-bold block mb-1 text-[#e8d5a0]">Tören Saati</span>
                <span class="text-[0.95rem]">15:00</span>
              </div>
            </div>
            
            <a 
              href="https://www.google.com/maps/dir/?api=1&destination=Polen+Restoran+Bornova+İzmir&travelmode=driving" 
              target="_blank" 
              class="inline-flex items-center gap-2 bg-white text-[#2d6a4f] px-[35px] py-[15px] rounded-full font-bold mt-[25px] transition-all border-2 border-[#c9a84c] relative z-10 shadow-[0_5px_15px_rgba(0,0,0,0.2)] hover:translate-y-[-3px] hover:scale-105 active:translate-y-[-1px] active:scale-[0.98]" style="animation: buttonPulse 2s infinite;"
            >
              <i class="fas fa-route"></i>
              Yol Tarifi Al
            </a>
            
            <p class="text-center mt-[10px] p-2 text-[0.85rem] text-[rgba(255,255,255,0.7)] relative z-10">
              <i class="fas fa-info-circle"></i> Butona tıklandığında haritada yol tarifi açılacaktır
            </p>
          </div>
        </div>
      </section>

      <!-- Gallery Section -->
      <section id="galeri" class="py-12 px-6 max-w-[850px] mx-auto text-center">
        <div class="card bg-[#f5f9f5] rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.4)] border-t-[5px] border-[#c9a84c] p-12 mb-10 opacity-0 transform translate-y-[30px] transition-all duration-700">
          <i class="fas fa-camera-retro text-[2.5rem] text-[#40916c]"></i>
          <h2 class="my-[15px]">Dijital Anı Defteri</h2>
          <div class="border-2 border-dashed border-[#c9a84c] p-8 rounded-[18px] cursor-pointer bg-[rgba(201,168,76,0.05)]" @click="$refs.weddingFile.click()">
            <i class="fas fa-cloud-upload-alt text-[#c9a84c] text-[2.5rem]"></i>
            <p class="font-bold mt-2">{{ fileNameDisplay }}</p>
            <img v-if="previewImg" :src="previewImg" class="w-full rounded-[10px] mt-4">
          </div>
          <input 
            ref="weddingFile"
            type="file" 
            name="weddingFile" 
            accept="image/*" 
            class="hidden"
            @change="handleFile"
          >
          <button class="w-full bg-linear-to-br from-[#2d6a4f] to-[#40916c] text-white border border-[#c9a84c] py-[1.1rem] rounded-full font-bold cursor-pointer transition-all mt-4 disabled:opacity-60 disabled:cursor-not-allowed active:scale-[0.98]" @click="uploadPhoto" :disabled="uploadLoading">
            <span v-if="uploadLoading"><i class="fas fa-spinner fa-spin"></i> Yükleniyor...</span>
            <span v-else>FOTOĞRAFI GÖNDER</span>
          </button>
        </div>
      </section>

      <!-- RSVP Section -->
      <section id="rsvp" class="py-12 px-6 max-w-[850px] mx-auto text-center">
        <div class="card bg-[#f5f9f5] rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.4)] border-t-[5px] border-[#c9a84c] p-12 mb-10 opacity-0 transform translate-y-[30px] transition-all duration-700">
          <i class="fas fa-envelope-open-text text-[2.5rem] text-[#9a7b35]"></i>
          <h2 class="mb-5">Katılım Bildirimi</h2>
          <form @submit.prevent="submitRsvp">
            <div class="grid grid-cols-2 gap-2.5 mb-2.5">
              <input 
                v-model="rsvpForm.ad" 
                type="text" 
                placeholder="Adınız" 
                class="w-full p-[0.9rem] border border-gray-300 rounded-xl mb-2.5"
                required
              >
              <input 
                v-model="rsvpForm.soyad" 
                type="text" 
                placeholder="Soyadınız" 
                class="w-full p-[0.9rem] border border-gray-300 rounded-xl mb-2.5"
                required
              >
            </div>
            <div class="grid grid-cols-2 gap-2.5">
              <select v-model="rsvpForm.katilim_durumu" class="w-full p-[0.9rem] border border-gray-300 rounded-xl mb-2.5" required>
                <option value="">Durum</option>
                <option value="var">🎉 Katılıyorum</option>
                <option value="yok">😔 Katılamıyorum</option>
              </select>
              <select v-model="rsvpForm.kisi_sayisi" class="w-full p-[0.9rem] border border-gray-300 rounded-xl mb-2.5">
                <option value="1">1 Kişi</option>
                <option value="2">2 Kişi</option>
                <option value="3+">3+ Kişi</option>
              </select>
            </div>
            <button type="submit" class="w-full bg-linear-to-br from-[#2d6a4f] to-[#40916c] text-white border border-[#c9a84c] py-[1.1rem] rounded-full font-bold cursor-pointer transition-all disabled:opacity-60 disabled:cursor-not-allowed active:scale-[0.98]" :disabled="rsvpLoading">
              <span v-if="rsvpLoading"><i class="fas fa-spinner fa-spin"></i> Kaydediliyor...</span>
              <span v-else>KAYDI TAMAMLA</span>
            </button>
          </form>
        </div>
      </section>

      <!-- Footer -->
      <footer class="text-center py-16 px-4">
        <h2 class="font-playfair font-bold italic text-4xl bg-linear-to-r from-[#9a7b35] via-[#e8d5a0] to-[#c9a84c] bg-clip-text text-transparent" style="background-size: 200% auto; animation: shine 3s linear infinite;">Hüma & Tuğcan</h2>
        <div class="mt-6">
          <p class="text-xs opacity-70 mb-4 text-slate-300">Design & Development by Eren G.</p>
          <div class="flex justify-center gap-2.5">
            <a href="https://www.linkedin.com/in/ya%C5%9Far-eren-g%C3%BCre-436696255/" target="_blank" class="inline-flex items-center gap-2 text-[#c9a84c] text-sm py-2.5 px-5 border border-[#c9a84c] rounded-full bg-[rgba(201,168,76,0.1)]">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            <a href="https://www.instagram.com/yasar.eren0/" target="_blank" class="inline-flex items-center gap-2 text-[#c9a84c] text-sm py-2.5 px-5 border border-[#c9a84c] rounded-full bg-[rgba(201,168,76,0.1)]">
              <i class="fab fa-instagram"></i> Instagram
            </a>
          </div>
        </div>
      </footer>
    </div>

    <!-- Success Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-[rgba(0,0,0,0.8)] z-[3000] flex justify-center items-center animate-fadeIn" @click.self="closeModal">
      <div class="bg-white rounded-[20px] text-center p-10 max-w-[90%] w-[400px] border-[3px] border-[#c9a84c] animate-slideIn">
        <div class="w-20 h-20 bg-linear-to-br from-[#2d6a4f] to-[#40916c] rounded-full flex items-center justify-center mx-auto mb-5 border-[3px] border-[#c9a84c]">
          <i class="fas fa-check text-white text-[2.5rem]"></i>
        </div>
        <h3 class="font-playfair text-[#2d6a4f] text-[1.8rem] mb-4">{{ modalTitle }}</h3>
        <p class="text-gray-600 mb-6 leading-relaxed">{{ modalMessage }}</p>
        <button class="bg-linear-to-br from-[#2d6a4f] to-[#40916c] text-white border-2 border-[#c9a84c] px-9 py-3 rounded-full font-bold transition-all hover:translate-y-[-2px] hover:shadow-[0_5px_15px_rgba(0,0,0,0.3)]" @click="closeModal">Tamam</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue'

// Refs
const particlesContainer = ref(null)
const envelopeWrapper = ref(null)
const mainEnvelope = ref(null)
const mainContent = ref(null)
const weddingFile = ref(null)

// State
const fileNameDisplay = ref('Görsel Seçin')
const previewImg = ref(null)
const uploadLoading = ref(false)
const rsvpLoading = ref(false)
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')

const countdown = reactive({
  days: 0,
  hours: 0,
  minutes: 0,
  seconds: 0
})

const rsvpForm = reactive({
  ad: '',
  soyad: '',
  katilim_durumu: '',
  kisi_sayisi: '1'
})

// Functions
const createParticles = () => {
  const container = particlesContainer.value
  
  if (!container) return
  
  for (let i = 0; i < 35; i++) {
    const particle = document.createElement('div')
    particle.className = 'particle animate-particleFloat'
    particle.style.left = Math.random() * 100 + '%'
    particle.style.width = particle.style.height = (Math.random() * 5 + 3) + 'px'
    particle.style.animationDelay = Math.random() * 5 + 's'
    particle.style.position = 'absolute'
    particle.style.background = '#c9a84c'
    particle.style.borderRadius = '50%'
    particle.style.opacity = '0.7'
    particle.style.boxShadow = '0 0 10px #c9a84c'
    container.appendChild(particle)
  }
}

const openEnvelope = () => {
  if (mainEnvelope.value.classList.contains('open')) return
  
  mainEnvelope.value.classList.add('open')
  const flap = mainEnvelope.value.querySelector('div:nth-child(2)')
  const waxSeal = mainEnvelope.value.querySelector('div:nth-child(3)')
  const letterCard = mainEnvelope.value.querySelector('div:nth-child(4)')
  
  if (flap) flap.style.transform = 'rotateX(180deg)'
  if (waxSeal) {
    waxSeal.style.opacity = '0'
    waxSeal.style.transform = 'translate(-50%, -100%) scale(0)'
  }
  if (letterCard) letterCard.style.transform = 'translateY(-75%) scale(1.05)'
  
  const contentItems = letterCard?.querySelectorAll('p, h1')
  contentItems?.forEach((item, idx) => {
    item.style.opacity = '1'
    item.style.transform = 'translateY(0)'
    item.style.transitionDelay = (1.5 + idx * 0.2) + 's'
  })
  
  setTimeout(() => {
    envelopeWrapper.value.style.opacity = '0'
    envelopeWrapper.value.style.transform = 'scale(1.1)'
    
    setTimeout(() => {
      envelopeWrapper.value.style.display = 'none'
      mainContent.value.classList.remove('hidden')
      mainContent.value.classList.add('visible')
      document.body.classList.remove('no-scroll')
      startCountdown()
      
      const cards = document.querySelectorAll('.card')
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.classList.remove('opacity-0', 'translate-y-[30px]')
          card.classList.add('opacity-100', 'translate-y-0')
        }, 200 * index)
      })
    }, 1000)
  }, 3500)
}

const handleFile = (event) => {
  const input = event.target
  if (input.files && input.files[0]) {
    fileNameDisplay.value = input.files[0].name
    
    const reader = new FileReader()
    reader.onload = (e) => {
      previewImg.value = e.target.result
    }
    reader.readAsDataURL(input.files[0])
  }
}

const getCSRFToken = () => {
  return document.querySelector('meta[name="csrf-token"]')?.content || ''
}

const uploadPhoto = async () => {
  if (!weddingFile.value.files[0]) {
    alert('Lütfen önce bir görsel seçin.')
    return
  }
  
  uploadLoading.value = true
  
  const formData = new FormData()
  formData.append('weddingFile', weddingFile.value.files[0])
  formData.append('_token', getCSRFToken())
  
  try {
    const response = await fetch('/upload-photo', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    
    const result = await response.text()
    
    if (response.ok) {
      showSuccessModal('Fotoğrafınız Albüme Eklendi!', 'Anı defterimize hoş geldiniz. Teşekkürler!')
      weddingFile.value.value = ''
      fileNameDisplay.value = 'Görsel Seçin'
      previewImg.value = null
    } else {
      alert('❌ ' + result)
    }
  } catch (error) {
    console.error('Upload error:', error)
    alert('Bir hata oluştu. Lütfen tekrar deneyin.')
  } finally {
    uploadLoading.value = false
  }
}

const submitRsvp = async () => {
  rsvpLoading.value = true
  
  const formData = new FormData()
  formData.append('ad', rsvpForm.ad)
  formData.append('soyad', rsvpForm.soyad)
  formData.append('katilim_durumu', rsvpForm.katilim_durumu)
  formData.append('kisi_sayisi', rsvpForm.kisi_sayisi)
  formData.append('_token', getCSRFToken())
  
  try {
    const response = await fetch('/rsvp-kaydet', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    
    const result = await response.text()
    
    if (response.ok) {
      showSuccessModal(
        'Katılımınız Kaydedildi!',
        'Değerli katılım bildiriminiz için teşekkür ederiz. Sizleri aramızda görmekten mutluluk duyacağız!'
      )
      Object.assign(rsvpForm, {
        ad: '',
        soyad: '',
        katilim_durumu: '',
        kisi_sayisi: '1'
      })
    } else {
      alert('❌ ' + result)
    }
  } catch (error) {
    console.error('RSVP error:', error)
    alert('Bir hata oluştu. Lütfen tekrar deneyin.')
  } finally {
    rsvpLoading.value = false
  }
}

const startCountdown = () => {
  const target = new Date('May 02, 2026 14:00:00').getTime()
  
  const updateCountdown = () => {
    const now = new Date().getTime()
    const diff = target - now
    
    if (diff < 0) return
    
    countdown.days = Math.floor(diff / (1000 * 60 * 60 * 24))
    countdown.hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
    countdown.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
    countdown.seconds = Math.floor((diff % (1000 * 60)) / 1000)
  }
  
  updateCountdown()
  setInterval(updateCountdown, 1000)
}

const showSuccessModal = (title, message) => {
  modalTitle.value = title
  modalMessage.value = message
  showModal.value = true
}

const closeModal = () => {
  showModal.value = false
}

onMounted(() => {
  document.body.classList.add('no-scroll')
  document.documentElement.style.overflow = 'hidden'
  createParticles()
})
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Lato:wght@300;400;700&family=Dancing+Script:wght@600;700&family=Noto+Serif+SC:wght@400;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

* {
  box-sizing: border-box;
  -webkit-tap-highlight-color: transparent;
}

html, body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

body {
  font-family: 'Lato', sans-serif;
  color: #333;
  line-height: 1.8;
}

body.no-scroll {
  overflow: hidden;
  height: 100dvh;
  position: fixed;
  width: 100%;
}

@keyframes particleFloat {
  0% {
    transform: translateY(105vh);
    opacity: 0;
  }
  50% {
    opacity: 0.8;
  }
  100% {
    transform: translateY(-10vh);
    opacity: 0;
  }
}

@keyframes shine {
  to {
    background-position: 200% center;
  }
}

@keyframes shimmer {
  0%, 100% {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(-30px, -30px);
  }
}

@keyframes hintBounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes buttonPulse {
  0%, 100% {
    box-shadow: 0 5px 15px rgba(0,0,0,0.2), 0 0 0 0 rgba(201,168,76,0.4);
  }
  50% {
    box-shadow: 0 5px 15px rgba(0,0,0,0.2), 0 0 0 12px rgba(201,168,76,0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideIn {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.particle {
  position: absolute;
}

.animate-particleFloat {
  animation: particleFloat 6s infinite ease-in-out;
}

.animate-fadeIn {
  animation: fadeIn 0.3s ease;
}

.animate-slideIn {
  animation: slideIn 0.4s ease;
}

.animate-shine {
  animation: shine 3s linear infinite;
}

.envelope.open .flap {
  transform: rotateX(180deg);
  z-index: 2;
}

.envelope.open .wax-seal {
  opacity: 0;
  transform: translate(-50%, -100%) scale(0);
}

#main-content.visible {
  display: block !important;
  opacity: 1 !important;
}

@media (max-width: 480px) {
  .wax-seal {
    width: 60px !important;
    height: 60px !important;
  }
  .wax-seal i {
    font-size: 1.5rem !important;
  }
  .location-box {
    padding: 25px 20px !important;
  }
  .location-title {
    font-size: 1.5rem !important;
  }
}
</style>
