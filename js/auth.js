document.addEventListener('DOMContentLoaded', () => {
    const { api, notify } = Ecoleta;
    const register = document.querySelector('#register-form');
    const login = document.querySelector('#login-form');

    if (register) {
        register.addEventListener('submit', async event => {
            event.preventDefault();
            const data = new FormData(register);
            const payload = {
                name: data.get('name').trim(),
                email: data.get('email').trim().toLowerCase(),
                password: data.get('password'),
                confirm: data.get('confirm'),
            };

            if (payload.password !== payload.confirm) {
                return notify('As senhas não coincidem.', 'error');
            }

            try {
                await api('api/auth.php?action=register', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                });
                notify('Conta criada! Redirecionando...');
                setTimeout(() => location.href = 'index.php', 700);
            } catch (err) {
                notify(err.message, 'error');
            }
        });
    }

    if (login) {
        login.addEventListener('submit', async event => {
            event.preventDefault();
            const data = new FormData(login);
            const payload = {
                email: data.get('email').trim().toLowerCase(),
                password: data.get('password'),
            };

            try {
                await api('api/auth.php?action=login', {
                    method: 'POST',
                    body: JSON.stringify(payload),
                });
                notify('Login realizado com sucesso!');
                setTimeout(() => location.href = 'index.php', 650);
            } catch (err) {
                notify(err.message, 'error');
            }
        });
    }
});