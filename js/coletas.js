document.addEventListener('DOMContentLoaded', async () => {
    const { api, currentUser, notify, escapeHTML, ready } = Ecoleta;
    await ready;

    const panel = document.querySelector('#request-panel');
    const form = document.querySelector('#collection-form');
    const list = document.querySelector('#collection-list');
    const filter = document.querySelector('#status-filter');
    let mine = [];

    const open = () => {
        if (!currentUser()) {
            notify('Entre na sua conta para registrar uma coleta.', 'error');
            setTimeout(() => location.href = 'login.php', 700);
            return;
        }
        panel.hidden = false;
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    document.querySelector('#open-request').addEventListener('click', open);
    document.querySelector('#empty-request')?.addEventListener('click', open);
    document.querySelector('#close-request').addEventListener('click', () => panel.hidden = true);

    const renderList = () => {
        const visible = filter.value === 'all'
            ? mine
            : mine.filter(item => item.status === filter.value);

        document.querySelector('#stat-total').textContent = mine.length;
        document.querySelector('#stat-pending').textContent = mine.filter(item => ['Recebida', 'Em andamento'].includes(item.status)).length;
        document.querySelector('#stat-done').textContent = mine.filter(item => item.status === 'Concluída').length;

        if (!visible.length) {
            list.innerHTML = `<div class="empty-state"><span>♻</span><h3>${mine.length ? 'Nenhum resultado neste filtro' : 'Nenhuma solicitação por enquanto'}</h3><p>${mine.length ? 'Experimente selecionar outro status.' : 'Quando você registrar uma coleta, ela aparecerá aqui.'}</p>${mine.length ? '' : '<button class="btn btn-primary" id="empty-request-again">Solicitar primeira coleta</button>'}</div>`;
            document.querySelector('#empty-request-again')?.addEventListener('click', open);
            return;
        }

        list.innerHTML = visible.map(item => `
            <article class="collection-item">
                <div>
                    <h3>${escapeHTML(item.material)} · ${escapeHTML(item.date)}</h3>
                    <p>${escapeHTML(item.address)} · ${escapeHTML(item.name)}</p>
                    <span class="status ${item.status === 'Concluída' ? 'done' : item.status === 'Cancelada' ? 'cancelled' : ''}">${escapeHTML(item.status)}</span>
                </div>
                <div class="item-actions">
                    ${item.status === 'Recebida' ? `<button class="small-action" data-cancel="${item.id}">Cancelar</button>` : ''}
                </div>
            </article>
        `).join('');

        list.querySelectorAll('[data-cancel]').forEach(button => {
            button.addEventListener('click', async () => {
                try {
                    await api('api/coletas.php?action=cancel', {
                        method: 'POST',
                        body: JSON.stringify({ id: Number(button.dataset.cancel) }),
                    });
                    notify('Solicitação cancelada.');
                    await loadCollections();
                } catch (err) {
                    notify(err.message, 'error');
                }
            });
        });
    };

    const loadCollections = async () => {
        if (!currentUser()) {
            mine = [];
            renderList();
            return;
        }
        try {
            const data = await api('api/coletas.php');
            mine = data.items || [];
            renderList();
        } catch (err) {
            notify(err.message, 'error');
        }
    };

    form.addEventListener('submit', async event => {
        event.preventDefault();
        const user = currentUser();
        if (!user) return open();

        const data = new FormData(form);
        const payload = {
            name: data.get('name').trim(),
            phone: data.get('phone').trim(),
            address: data.get('address').trim(),
            material: data.get('material'),
            date: data.get('date'),
            notes: data.get('notes').trim(),
        };

        try {
            await api('api/coletas.php', {
                method: 'POST',
                body: JSON.stringify(payload),
            });
            form.reset();
            if (currentUser()) form.elements.name.value = currentUser().name;
            panel.hidden = true;
            notify('Coleta solicitada com sucesso!');
            await loadCollections();
        } catch (err) {
            notify(err.message, 'error');
        }
    });

    filter.addEventListener('change', renderList);
    const date = form.elements.date;
    date.min = new Date().toISOString().slice(0, 10);
    if (currentUser()) form.elements.name.value = currentUser().name;

    await loadCollections();
});