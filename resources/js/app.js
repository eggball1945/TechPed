import './bootstrap';
import '../css/app.css';

// DROPDOWN PROFILE
const btn = document.getElementById('profileBtn');
const dropdown = document.getElementById('profileDropdown');

btn.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown.classList.toggle('opacity-0');
    dropdown.classList.toggle('scale-95');
    dropdown.classList.toggle('pointer-events-none');
    dropdown.classList.toggle('opacity-100');
    dropdown.classList.toggle('scale-100');
});

document.addEventListener('click', () => {
    dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
    dropdown.classList.remove('opacity-100', 'scale-100');
});

// FLASHSALE TIMER
const flashSaleEnd = new Date("2026-02-13 23:59:59").getTime();

const timer = setInterval(() => {
    const now = new Date().getTime();
    const distance = flashSaleEnd - now;

    if (distance <= 0) {
        clearInterval(timer);
        document.getElementById("flashsale-timer").innerHTML =
            "<span class='text-red-600 font-semibold'>Flash Sale Berakhir</span>";
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerText = String(days).padStart(2, '0');
    document.getElementById("hours").innerText = String(hours).padStart(2, '0');
    document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
    document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');

}, 1000);