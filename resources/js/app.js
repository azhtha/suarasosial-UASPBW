function createToast(type, message) {
    const toast = document.createElement('div');
    toast.className = [
        'toast',
        'pointer-events-auto',
        'w-full',
        'max-w-3xl',
        'rounded-3xl',
        'border',
        'px-5',
        'py-4',
        'shadow-2xl',
        'shadow-purple-500/10',
        'backdrop-blur-xl',
        'bg-white/95',
        'text-sm',
        'font-medium',
        'flex',
        'items-start',
        'gap-3',
        'ring-1',
        'transition',
        'duration-300',
        'ease-out',
        'transform',
        'opacity-0',
        'translate-y-[-0.75rem]'
    ].join(' ');

    if (type === 'success') {
        toast.classList.add('border-green-200', 'text-green-800');
    } else {
        toast.classList.add('border-red-200', 'text-red-800');
    }

    toast.innerHTML = `
        <div class="mt-0.5">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
        </div>
        <div class="break-words">${message}</div>
    `;

    return toast;
}

function showToast(type, message, duration = 4000) {
    const container = document.getElementById('toast-container');
    if (!container || !message) return;

    const toast = createToast(type, message);
    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.remove('opacity-0', 'translate-y-[-0.75rem]');
    });

    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-[-0.75rem]');
        toast.addEventListener('transitionend', () => toast.remove(), { once: true });
    }, duration);
}

function initToasts() {
    if (!window.toastMessages) return;

    if (window.toastMessages.success) {
        showToast('success', window.toastMessages.success);
    }

    if (window.toastMessages.error) {
        showToast('error', window.toastMessages.error);
    }

    if (window.toastMessages.validation) {
        showToast('error', window.toastMessages.validation);
    }
}

document.addEventListener('DOMContentLoaded', initToasts);

