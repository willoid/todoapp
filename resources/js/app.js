import './bootstrap';


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.alert-block').forEach(el => {
        setTimeout(() => {
            el.remove();
        }, 3000);
    });
});
