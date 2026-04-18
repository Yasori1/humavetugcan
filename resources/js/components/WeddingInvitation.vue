<script setup lang="ts">
import { ref, onMounted } from 'vue'

const fileName = ref('Görsel Seçin')
const previewImage = ref('')
const isUploading = ref(false)
const isSubmittingRsvp = ref(false)
const showSuccessModal = ref(false)
const successTitle = ref('')
const successMessage = ref('')
const countdown = ref({
    days: '00',
    hours: '00',
    minutes: '00',
    seconds: '00'
})

const form = ref({
    ad: '',
    soyad: '',
    katilim_durumu: '',
    kisi_sayisi: '1'
})

onMounted(() => {
    generateParticles()
    setupEnvelopeListener()
    startCountdown()
})

const generateParticles = () => {
    const container = document.getElementById('particles')
    if (container) {
        for (let i = 0; i < 35; i++) {
            const p = document.createElement('div')
            p.className = 'particle'
            p.style.left = Math.random() * 100 + '%'
            p.style.width = p.style.height = (Math.random() * 5 + 3) + 'px'
            p.style.animationDelay = Math.random() * 5 + 's'
            container.appendChild(p)
        }
    }
}

const setupEnvelopeListener = () => {
    const envelope = document.getElementById('main-envelope')
    if (envelope) {
        envelope.addEventListener('click', () => {
            if (envelope.classList.contains('open')) return
            envelope.classList.add('open')
            setTimeout(() => {
                const wrapper = document.getElementById('envelope-wrapper')
                const main = document.getElementById('main-content')
                if (wrapper && main) {
                    wrapper.style.opacity = '0'
                    wrapper.style.transform = 'scale(1.1)'
                    setTimeout(() => {
                        wrapper.style.display = 'none'
                        main.classList.add('visible')
                        setTimeout(() => {
                            document.querySelectorAll('.card').forEach((c, i) => {
                                setTimeout(() => c.classList.add('show'), 200 * i)
                            })
                        }, 200)
                    }, 1000)
                }
            }, 3500)
        })
    }
}

const handleFileInput = (event: Event) => {
    const target = event.target as HTMLInputElement
    if (target.files && target.files[0]) {
        fileName.value = target.files[0].name
        const reader = new FileReader()
        reader.onload = (e) => {
            previewImage.value = e.target?.result as string
        }
        reader.readAsDataURL(target.files[0])
    }
}

const uploadPhoto = async () => {
    const fileInput = document.getElementById('weddingFile') as HTMLInputElement
    if (!fileInput.files?.[0]) {
        alert('Lütfen önce bir görsel seçin.')
        return
    }

    isUploading.value = true
    const formData = new FormData()
    formData.append('weddingFile', fileInput.files[0])

    try {
        const response = await fetch('/upload-photo', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })

        if (response.ok) {
            showSuccessModal.value = true
            successTitle.value = 'Fotoğrafınız Albüme Eklendi!'
            successMessage.value = 'Anı defterimize hoş geldiniz. Teşekkürler!'
            fileInput.value = ''
            fileName.value = 'Görsel Seçin'
            previewImage.value = ''
        } else {
            alert('❌ ' + await response.text())
        }
    } catch (error) {
        console.error('Upload error:', error)
        alert('Bir hata oluştu. Lütfen tekrar deneyin.')
    } finally {
        isUploading.value = false
    }
}

const submitRsvp = async (e: Event) => {
    e.preventDefault()
    isSubmittingRsvp.value = true

    const formData = new FormData()
    formData.append('ad', form.value.ad)
    formData.append('soyad', form.value.soyad)
    formData.append('katilim_durumu', form.value.katilim_durumu)
    formData.append('kisi_sayisi', form.value.kisi_sayisi)

    try {
        const response = await fetch('/rsvp-kaydet', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })

        if (response.ok) {
            showSuccessModal.value = true
            successTitle.value = 'Katılımınız Kaydedildi!'
            successMessage.value = 'Değerli katılım bildiriminiz için teşekkür ederiz. Sizleri aramızda görmekten mutluluk duyacağız!'
            form.value = { ad: '', soyad: '', katilim_durumu: '', kisi_sayisi: '1' }
        } else {
            alert('❌ ' + await response.text())
        }
    } catch (error) {
        console.error('RSVP error:', error)
        alert('Bir hata oluştu. Lütfen tekrar deneyin.')
    } finally {
        isSubmittingRsvp.value = false
    }
}

const startCountdown = () => {
    const updateCountdown = () => {
        const target = new Date('May 02, 2026 14:00:00').getTime()
        const now = new Date().getTime()
        const d = target - now
        if (d < 0) return
        countdown.value.days = String(Math.floor(d / (1000 * 60 * 60 * 24))).padStart(2, '0')
        countdown.value.hours = String(Math.floor((d % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0')
        countdown.value.minutes = String(Math.floor((d % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0')
        countdown.value.seconds = String(Math.floor((d % (1000 * 60)) / 1000)).padStart(2, '0')
    }
    updateCountdown()
    setInterval(updateCountdown, 1000)
}

const closeModal = () => {
    showSuccessModal.value = false
}

const triggerFileInput = () => {
    document.getElementById('weddingFile')?.click()
}
</script>

<template>
  <div class="body-wrapper">
    <!-- Particles -->
    <div id="particles" class="particles"></div>

    <!-- Envelope Wrapper -->
    <div id="envelope-wrapper" class="envelope-wrapper">
      <!-- Main Envelope -->
      <div id="main-envelope" class="envelope">
        <!-- Back -->
        <div class="envelope-back"></div>

        <!-- Flap Front -->
        <div class="envelope-flap-front">
          <div class="envelope-flap-front-left"></div>
          <div class="envelope-flap-front-right"></div>
        </div>

        <!-- Flap Back -->
        <div class="envelope-flap-back">
          <div class="envelope-flap-back-left"></div>
          <div class="envelope-flap-back-right"></div>
        </div>

        <!-- Wax Seal -->
        <div class="wax-seal"></div>

        <!-- Letter -->
        <div class="letter">
          <div class="paper"></div>
        </div>
      </div>

      <!-- Click Text -->
      <p class="click-text">💌 Davetiyeyi Aç / Click to Open 💌</p>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="main-content">
      <!-- Hüma Card -->
      <div class="card bride-card">
        <div class="emoji">👰</div>
        <h2>Hüma</h2>
        <p>Gelin / Bride</p>
      </div>

      <!-- Heart Card -->
      <div class="card heart-card">
        <div class="emoji">❤️</div>
        <p>& Love</p>
      </div>

      <!-- Tuğcan Card -->
      <div class="card groom-card">
        <div class="emoji">🤵</div>
        <h2>Tuğcan</h2>
        <p>Damat / Groom</p>
      </div>

      <!-- Countdown -->
      <div class="countdown-section">
        <h3>2 Mayıs 2026'ye Kalan Süre</h3>
        <div class="countdown">
          <div class="countdown-item">
            <span class="countdown-number">{{ countdown.days }}</span>
            <span class="countdown-label">Gün</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-number">{{ countdown.hours }}</span>
            <span class="countdown-label">Saat</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-number">{{ countdown.minutes }}</span>
            <span class="countdown-label">Dakika</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-number">{{ countdown.seconds }}</span>
            <span class="countdown-label">Saniye</span>
          </div>
        </div>
      </div>

      <!-- Photo Gallery Section -->
      <div class="photo-section">
        <h3>📸 Anı Defterine Fotoğraf Ekle</h3>
        <div class="photo-upload-container">
          <input 
            id="weddingFile" 
            type="file" 
            accept="image/*" 
            @change="handleFileInput"
            style="display: none"
          />
          <button class="upload-btn" @click="triggerFileInput">
            {{ fileName }}
          </button>
          <button class="upload-submit-btn" @click="uploadPhoto" :disabled="isUploading">
            {{ isUploading ? 'Yükleniyor...' : 'Fotoğrafı Yükle' }}
          </button>
        </div>
        <div v-if="previewImage" class="preview-container">
          <img :src="previewImage" alt="Preview" class="preview-image" />
        </div>
      </div>

      <!-- RSVP Section -->
      <div class="rsvp-section">
        <h3>💕 Katılım Durumunuzu Bildirin</h3>
        <form @submit="submitRsvp">
          <div class="form-group">
            <input 
              v-model="form.ad" 
              type="text" 
              placeholder="Adınız" 
              required
            />
          </div>
          <div class="form-group">
            <input 
              v-model="form.soyad" 
              type="text" 
              placeholder="Soyadınız" 
              required
            />
          </div>
          <div class="form-group">
            <select v-model="form.katilim_durumu" required>
              <option value="">Katılım Durumu Seçin</option>
              <option value="Katılacağım">Katılacağım ✅</option>
              <option value="Katılamayacağım">Katılamayacağım ❌</option>
            </select>
          </div>
          <div class="form-group">
            <input 
              v-model="form.kisi_sayisi" 
              type="number" 
              min="1" 
              placeholder="Kişi Sayısı"
              required
            />
          </div>
          <button 
            type="submit" 
            class="submit-btn" 
            :disabled="isSubmittingRsvp"
          >
            {{ isSubmittingRsvp ? 'Gönderiliyor...' : 'Katılımı Kaydet' }}
          </button>
        </form>
      </div>
    </div>

    <!-- Success Modal -->
    <div v-if="showSuccessModal" class="modal-overlay" @click="closeModal">
      <div class="modal-content" @click.stop>
        <div class="modal-emoji">✨</div>
        <h2>{{ successTitle }}</h2>
        <p>{{ successMessage }}</p>
        <button class="modal-close-btn" @click="closeModal">Kapat</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
:root {
  --bg-gradient: linear-gradient(135deg, #0b1a0b 0%, #1a2e1a 50%, #0f2618 100%);
  --primary-green: #2d6a4f;
  --bright-green: #40916c;
  --gold: #c9a84c;
  --gold-light: #e8d5a0;
  --gold-dark: #9a7b35;
  --cream: #f5f9f5;
  --envelope-cream: #faf6f1;
  --envelope-beige: #f0e8dc;
  --envelope-tan: #e6d5c3;
  --wax-seal-gold: #d4af37;
  --particle-gradient: linear-gradient(to right, #9a7b35 20%, #e8d5a0 40%, #c9a84c 60%, #9a7b35 80%);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.body-wrapper {
  min-height: 100vh;
  width: 100%;
  background: linear-gradient(135deg, #0b1a0b 0%, #1a2e1a 50%, #0f2618 100%);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  position: relative;
  z-index: 2;
}

/* Particles */
.particles {
  position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
  z-index: 1;
  background: none;
}

.particle {
  position: absolute;
  background: linear-gradient(to right, #9a7b35 20%, #e8d5a0 40%, #c9a84c 60%, #9a7b35 80%);
  border-radius: 50%;
  animation: float 5s ease-in-out infinite;
  box-shadow: 0 0 10px rgba(201, 168, 76, 0.6);
}

@keyframes float {
  0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0; }
  50% { opacity: 1; }
  100% { transform: translateY(-100px) translateX(50px); opacity: 0; }
}

/* Envelope */
.envelope-wrapper {
  position: relative;
  z-index: 3;
  margin-bottom: 40px;
  transition: all 1s ease;
}

.envelope {
  width: 300px;
  height: 200px;
  background: linear-gradient(135deg, #faf6f1 0%, #f0e8dc 100%);
  border-radius: 10px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  position: relative;
  cursor: pointer;
  transition: all 0.3s ease;
  transform-style: preserve-3d;
}

.envelope:hover {
  transform: translateY(-5px);
  box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
}

.envelope.open {
  animation: envelopeOpen 3.5s ease-out forwards;
}

@keyframes envelopeOpen {
  0% {
    transform: rotateX(0deg) rotateY(0deg);
  }
  50% {
    transform: rotateX(25deg) rotateY(0deg);
  }
  100% {
    transform: rotateX(0deg) rotateY(0deg);
  }
}

.envelope-back {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #e6d5c3 0%, #d4af37 100%);
  border-radius: 10px;
  position: absolute;
  z-index: 0;
}

.envelope-flap-front {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 50%;
  z-index: 2;
}

.envelope-flap-front-left {
  position: absolute;
  width: 50%;
  height: 100%;
  background: linear-gradient(135deg, #faf6f1 0%, #f0e8dc 100%);
  clip-path: polygon(0 0, 100% 100%, 0 100%);
  animation: flapOpenLeft 1s ease-out forwards;
}

.envelope-flap-front-right {
  position: absolute;
  right: 0;
  width: 50%;
  height: 100%;
  background: linear-gradient(135deg, #f0e8dc 0%, #e6d5c3 100%);
  clip-path: polygon(0 100%, 100% 0, 100% 100%);
  animation: flapOpenRight 1s ease-out forwards;
}

@keyframes flapOpenLeft {
  0% { transform: translateY(0); opacity: 1; }
  100% { transform: translateY(-120%) rotateZ(-45deg); opacity: 0.3; }
}

@keyframes flapOpenRight {
  0% { transform: translateY(0); opacity: 1; }
  100% { transform: translateY(-120%) rotateZ(45deg); opacity: 0.3; }
}

.envelope-flap-back {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 50%;
  z-index: 1;
  display: none;
}

.envelope-flap-back-left,
.envelope-flap-back-right {
  position: absolute;
  width: 50%;
  height: 100%;
  background: linear-gradient(135deg, #e6d5c3 0%, #d4af37 100%);
}

.wax-seal {
  position: absolute;
  width: 60px;
  height: 60px;
  background: radial-gradient(circle at 30% 30%, #d4af37, #c9a84c);
  border-radius: 50%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 3;
  box-shadow: 0 10px 30px rgba(201, 168, 76, 0.4);
  animation: sealAppear 1s ease-out forwards, sealGlow 2s ease-in-out infinite 1s;
}

@keyframes sealAppear {
  0% { opacity: 0; transform: translate(-50%, -50%) scale(0); }
  100% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
}

@keyframes sealGlow {
  0%, 100% { box-shadow: 0 10px 30px rgba(201, 168, 76, 0.4); }
  50% { box-shadow: 0 10px 40px rgba(201, 168, 76, 0.8); }
}

.letter {
  position: absolute;
  width: 260px;
  height: 160px;
  background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
  top: 20px;
  left: 20px;
  border-radius: 5px;
  box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 4;
  animation: letterRise 2s ease-out 1.5s forwards;
  opacity: 0;
  transform: translateY(0);
}

@keyframes letterRise {
  0% { opacity: 0; transform: translateY(30px); }
  100% { opacity: 1; transform: translateY(-80px); }
}

.paper {
  width: 100%;
  height: 100%;
  padding: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: #333;
  font-weight: 300;
  font-size: 14px;
}

.click-text {
  margin-top: 20px;
  color: #d4af37;
  font-size: 16px;
  font-weight: 600;
  animation: pulse 2s ease-in-out infinite;
  z-index: 1;
}

@keyframes pulse {
  0%, 100% { opacity: 0.7; }
  50% { opacity: 1; }
}

/* Main Content */
.main-content {
  display: none;
  flex-direction: column;
  gap: 40px;
  width: 100%;
  max-width: 900px;
  z-index: 3;
  position: relative;
}

.main-content.visible {
  display: flex;
  animation: fadeIn 0.8s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.card {
  background: white;
  border-radius: 15px;
  padding: 30px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}

.card.show {
  opacity: 1;
  transform: translateY(0);
}

.card h2 {
  font-size: 32px;
  color: #c9a84c;
  margin: 15px 0 5px;
}

.card p {
  color: #6b7280;
  font-size: 14px;
}

.emoji {
  font-size: 64px;
  margin-bottom: 10px;
}

.bride-card,
.groom-card {
  display: inline-block;
  width: 45%;
}

.heart-card {
  display: inline-block;
  width: 10%;
  vertical-align: middle;
  font-size: 48px;
  background: transparent;
  box-shadow: none;
  padding: 0;
}

.countdown-section {
  background: white;
  border-radius: 15px;
  padding: 30px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.countdown-section h3 {
  font-size: 20px;
  color: #1f2937;
  margin-bottom: 20px;
}

.countdown {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.countdown-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  background: linear-gradient(135deg, #e8d5a0 0%, #c9a84c 100%);
  padding: 20px;
  border-radius: 10px;
  min-width: 80px;
}

.countdown-number {
  font-size: 32px;
  font-weight: bold;
  color: #0b1a0b;
}

.countdown-label {
  font-size: 12px;
  color: #1a2e1a;
  margin-top: 5px;
}

.photo-section {
  background: white;
  border-radius: 15px;
  padding: 30px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.photo-section h3 {
  font-size: 20px;
  color: #1f2937;
  margin-bottom: 20px;
}

.photo-upload-container {
  display: flex;
  gap: 10px;
  justify-content: center;
  flex-wrap: wrap;
}

.upload-btn,
.upload-submit-btn {
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
}

.upload-btn {
  background: linear-gradient(135deg, #40916c 0%, #2d6a4f 100%);
  color: white;
}

.upload-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(64, 145, 108, 0.4);
}

.upload-submit-btn {
  background: linear-gradient(135deg, #c9a84c 0%, #9a7b35 100%);
  color: white;
}

.upload-submit-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(201, 168, 76, 0.4);
}

.upload-submit-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.preview-container {
  margin-top: 20px;
  display: inline-block;
}

.preview-image {
  max-width: 300px;
  max-height: 300px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.rsvp-section {
  background: white;
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.rsvp-section h3 {
  font-size: 20px;
  color: #1f2937;
  margin-bottom: 20px;
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 12px;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 14px;
  transition: all 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
  outline: none;
  border-color: #c9a84c;
  box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.1);
}

.submit-btn {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #40916c 0%, #2d6a4f 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.submit-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(64, 145, 108, 0.4);
}

.submit-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  animation: fadeIn 0.3s ease;
}

.modal-content {
  background: white;
  border-radius: 15px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  animation: slideUp 0.3s ease;
  max-width: 400px;
}

@keyframes slideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.modal-emoji {
  font-size: 64px;
  margin-bottom: 20px;
  animation: bounce 1s ease infinite;
}

@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}

.modal-content h2 {
  font-size: 24px;
  color: #1f2937;
  margin-bottom: 10px;
}

.modal-content p {
  color: #6b7280;
  margin-bottom: 20px;
  font-size: 14px;
}

.modal-close-btn {
  padding: 12px 30px;
  background: linear-gradient(135deg, #c9a84c 0%, #9a7b35 100%);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.modal-close-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(201, 168, 76, 0.4);
}

@media (max-width: 768px) {
  .bride-card,
  .groom-card {
    width: 100%;
  }

  .heart-card {
    width: 100%;
  }

  .countdown {
    gap: 10px;
  }

  .countdown-item {
    min-width: 60px;
    padding: 15px;
  }

  .countdown-number {
    font-size: 24px;
  }

  .envelope {
    width: 250px;
    height: 170px;
  }

  .card {
    padding: 20px;
  }

  .card h2 {
    font-size: 24px;
  }

  .emoji {
    font-size: 48px;
  }
}
</style>
