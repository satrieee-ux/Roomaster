
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
