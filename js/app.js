const Ecoleta = (() => {
    let cachedUser = null;

    const api = async (url, options = {}) => {
        const config = {
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                ...(options.body ? { 'Content-Type': 'application/json' } : {}),
                ...(options.headers || {}),
            },
            ...options,
        };
        const response = await fetch(url, config);
        const payload = await response.json().catch(() => ({ ok: false, message: 'Resposta inválida do servidor.' }));
        if (!response.ok || payload.ok === false) {
            throw new Error(payload.message || 'Erro na requisição.');
        }
        return payload;
    };

    const currentUser = () => cachedUser;

    const fetchSession = async () => {
        try {
            const data = await api('api/auth.php?action=session');
            cachedUser = data.user || null;
        } catch {
            cachedUser = null;
        }
        return cachedUser;
    };

    const notify = (message, type = 'success') => {
        const region = document.querySelector('.toast-region');
        if (!region) return;
        const toast = document.createElement('div');
        toast.className = `toast ${type === 'error' ? 'error' : ''}`;
        toast.textContent = message;
        region.append(toast);
        setTimeout(() => toast.remove(), 3600);
    };

    const escapeHTML = value => String(value ?? '').replace(/[&<>"']/g, char => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[char]));

    const updateAccount = () => {
        const slot = document.querySelector('[data-account]');
        if (!slot) return;
        const user = currentUser();
        slot.innerHTML = user
            ? `<span>Olá, ${escapeHTML(user.name.split(' ')[0])}</span> · <a href="#" data-logout>Sair</a>`
            : '<a href="login.php">Entrar</a>';

        slot.querySelector('[data-logout]')?.addEventListener('click', async event => {
            event.preventDefault();
            try {
                await api('api/auth.php?action=logout', { method: 'POST' });
                cachedUser = null;
                notify('Você saiu da sua conta.');
                setTimeout(() => location.href = 'index.php', 500);
            } catch (err) {
                notify(err.message, 'error');
            }
        });
    };

    const setupMenu = () => {
        const button = document.querySelector('.menu-toggle');
        const nav = document.querySelector('.nav');
        if (!button || !nav) return;
        button.addEventListener('click', () => {
            const open = nav.classList.toggle('open');
            button.setAttribute('aria-expanded', String(open));
            button.textContent = open ? '×' : '☰';
        });
    };

    const ready = (async () => {
        if (document.readyState === 'loading') {
            await new Promise(resolve => document.addEventListener('DOMContentLoaded', resolve, { once: true }));
        }
        setupMenu();
        await fetchSession();
        updateAccount();
        return cachedUser;
    })();

    return { api, currentUser, fetchSession, notify, escapeHTML, updateAccount, ready };
})();