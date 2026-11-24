document.addEventListener('DOMContentLoaded', async () => {
    const { api, escapeHTML } = Ecoleta;
    const search = document.querySelector('#point-search');
    const filter = document.querySelector('#material-filter');
    const grid = document.querySelector('#point-list');
    const empty = document.querySelector('#no-points');

    const iconClassMap = {
        green: '',
        blue: 'icon-blue',
        yellow: 'icon-yellow',
    };

    try {
        const data = await api('api/pontos.php');
        if (Array.isArray(data.items) && data.items.length > 0) {
            grid.innerHTML = data.items.map(ponto => {
                const materiaisList = String(ponto.materiais || '').split(',').map(m => m.trim()).filter(Boolean);
                const searchIndex = `${ponto.nome} ${ponto.endereco} ${ponto.descricao} ${materiaisList.join(' ')}`.toLocaleLowerCase('pt-BR');
                const iconClass = iconClassMap[ponto.cor_icone] || '';
                return `
                    <article class="point-card" data-material="${escapeHTML(materiaisList.join(','))}" data-search="${escapeHTML(searchIndex)}">
                        <div class="point-top">
                            <span class="point-icon ${iconClass}">${escapeHTML(ponto.icone || '♻')}</span>
                            <span class="point-type">${escapeHTML(ponto.categoria)}</span>
                        </div>
                        <h2>${escapeHTML(ponto.nome)}</h2>
                        <p>${escapeHTML(ponto.descricao)}</p>
                        <div class="point-meta">
                            <span>⌖ Endereço</span>
                            <strong>${escapeHTML(ponto.endereco)}</strong>
                        </div>
                        <div class="material-tags">
                            ${materiaisList.map(m => `<span>${escapeHTML(m)}</span>`).join('')}
                        </div>
                    </article>
                `;
            }).join('');
        }
    } catch {
        
    }

    const apply = () => {
        const cards = [...document.querySelectorAll('.point-card')];
        const term = search.value.toLocaleLowerCase('pt-BR').trim();
        const material = filter.value;
        let count = 0;

        cards.forEach(card => {
            const matchesText = card.dataset.search.toLocaleLowerCase('pt-BR').includes(term) ||
                card.textContent.toLocaleLowerCase('pt-BR').includes(term);
            const matchesMaterial = material === 'all' || card.dataset.material.split(',').includes(material);
            const visible = matchesText && matchesMaterial;
            card.hidden = !visible;
            if (visible) count++;
        });

        empty.hidden = count !== 0;
    };

    search.addEventListener('input', apply);
    filter.addEventListener('change', apply);
});