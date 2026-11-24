document.addEventListener('DOMContentLoaded', () => {
    const { api, notify } = Ecoleta;
    const form = document.querySelector('#contact-form');

    form.addEventListener('submit', async event => {
        event.preventDefault();
        const data = new FormData(form);
        const payload = {
            name: data.get('name').trim(),
            email: data.get('email').trim(),
            subject: data.get('subject').trim(),
            message: data.get('message').trim(),
        };

        try {
            const res = await api('api/contato.php', {
                method: 'POST',
                body: JSON.stringify(payload),
            });
            form.reset();
            notify(res.message || 'Mensagem enviada com sucesso!');
        } catch (err) {
            notify(err.message, 'error');
        }
    });
});