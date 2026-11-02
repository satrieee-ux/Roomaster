
import '../css/app.css';

import { createIcons, icons } from 'lucide';

const initLucide = () => {
    createIcons({
        icons,
        nameAttr: 'data-lucide',
        attrs: {
            'stroke-width': 2,
        }
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLucide);
} else {
    initLucide();
}

/* ---------------- Calendar (modal Choose Date) ---------------- */
const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const pad = (n) => String(n).padStart(2, '0');

const renderCalendar = (root) => {
    const year = +root.dataset.year;
    const month = +root.dataset.month; // 1–12
    const selected = root.dataset.value || '';

    root.querySelector('[data-cal-title]').textContent = MONTHS[month - 1];

    const lead = new Date(year, month - 1, 1).getDay();
    const total = Math.ceil((lead + new Date(year, month, 0).getDate()) / 7) * 7;
    const grid = root.querySelector('[data-cal-grid]');
    grid.innerHTML = '';

    for (let i = 0; i < total; i++) {
        const d = new Date(year, month - 1, 1 - lead + i);
        const iso = `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
        const outside = d.getMonth() !== month - 1;
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.dataset.date = iso;
        btn.textContent = d.getDate();
        btn.className = 'mx-auto flex h-9 w-9 items-center justify-center rounded-full text-b3 transition-colors '
            + (iso === selected ? '!bg-primary-800 !text-white'
                : outside ? 'text-grey-400 hover:bg-grey-100' : 'text-grey-900 hover:bg-primary-50');
        grid.appendChild(btn);
    }
};

const initCalendars = () => document.querySelectorAll('[data-calendar]').forEach(renderCalendar);
if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initCalendars);
else initCalendars();

document.addEventListener('click', (e) => {
    const root = e.target.closest('[data-calendar]');
    if (!root) return;

    const shift = e.target.closest('[data-cal-prev]') ? -1 : e.target.closest('[data-cal-next]') ? 1 : 0;
    if (shift) {
        const d = new Date(+root.dataset.year, +root.dataset.month - 1 + shift, 1);
        root.dataset.year = d.getFullYear();
        root.dataset.month = d.getMonth() + 1;
        renderCalendar(root);
        return;
    }

    const day = e.target.closest('[data-date]');
    if (day) {
        const [y, m] = day.dataset.date.split('-');
        root.dataset.value = day.dataset.date;
        root.dataset.year = +y;
        root.dataset.month = +m;
        root.querySelector('[data-cal-input]').value = day.dataset.date;
        renderCalendar(root);
        return;
    }

    if (e.target.closest('[data-cal-apply]')) {
        root.dispatchEvent(new CustomEvent('date-selected', { bubbles: true, detail: { value: root.dataset.value || '' } }));
    }
});
