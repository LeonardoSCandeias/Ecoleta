<?php
$pageTitle   = 'Coletas';
$activePage  = 'coletas';
$pageScripts = ['js/coletas.js'];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
    <main class="page-wrap">
        <section class="page-heading">
            <div>
                <span class="eyebrow">ORGANIZE SEU DESCARTE</span>
                <h1>Minhas coletas</h1>
                <p>Solicite uma retirada e acompanhe o andamento dos seus registros.</p>
            </div>
            <button class="btn btn-primary" id="open-request">+ Nova solicitação</button>
        </section>
        <section class="stats-grid">
            <article class="stat-card">
                <span>Total de solicitações</span>
                <strong id="stat-total">0</strong>
                <small>Registros na sua conta</small>
            </article>
            <article class="stat-card">
                <span>Em análise</span>
                <strong id="stat-pending">0</strong>
                <small>Aguardando atendimento</small>
            </article>
            <article class="stat-card">
                <span>Concluídas</span>
                <strong id="stat-done">0</strong>
                <small>Coletas finalizadas</small>
            </article>
        </section>
        <section class="panel" id="request-panel" hidden>
            <div class="panel-heading">
                <div>
                    <span class="eyebrow">NOVA SOLICITAÇÃO</span>
                    <h2>Conte o que precisa coletar</h2>
                </div>
                <button class="icon-button" id="close-request" aria-label="Fechar formulário">×</button>
            </div>
            <form id="collection-form" class="form-grid">
                <label>Nome
                    <input name="name" required minlength="3" placeholder="Seu nome">
                </label>
                <label>Telefone
                    <input name="phone" required placeholder="(00) 00000-0000">
                </label>
                <label class="field-wide">Endereço
                    <input name="address" required placeholder="Rua, número e bairro">
                </label>
                <label>Material
                    <select name="material" required>
                        <option value="">Selecione</option>
                        <option>Papel</option>
                        <option>Plástico</option>
                        <option>Vidro</option>
                        <option>Metal</option>
                        <option>Eletrônicos</option>
                        <option>Óleo de cozinha</option>
                        <option>Outros</option>
                    </select>
                </label>
                <label>Data desejada
                    <input name="date" type="date" required>
                </label>
                <label class="field-wide">Observações
                    <textarea name="notes" rows="3" placeholder="Informações adicionais (opcional)"></textarea>
                </label>
                <div class="field-wide form-actions">
                    <button class="btn btn-primary" type="submit">Salvar solicitação</button>
                    <button class="btn btn-ghost" type="reset">Limpar</button>
                </div>
            </form>
        </section>
        <section class="panel">
            <div class="list-toolbar">
                <h2>Histórico de solicitações</h2>
                <select id="status-filter" aria-label="Filtrar por status">
                    <option value="all">Todos os status</option>
                    <option value="Recebida">Recebida</option>
                    <option value="Em andamento">Em andamento</option>
                    <option value="Concluída">Concluída</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>
            <div class="collection-list" id="collection-list"></div>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>