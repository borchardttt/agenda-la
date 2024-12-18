<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Serviços - Agenda-la</title>
    <script src="https://cdn.tailwindcss.com"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">
            <h1>Agenda-la - Gerenciar Serviços</h1>
        </div>
        <nav class="space-x-4">
            <a href="/admin" class="hover:text-[#D3B18C]">Admin Home</a>
            <a href="/admin/users" class="hover:text-[#D3B18C]">Usuários</a>
        </nav>
    </div>
</header>

<section class="container mx-auto py-10">
    <h2 class="text-3xl font-semibold mb-6">Gerenciar Serviços</h2>

    <!-- Formulário para criar um novo serviço -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-10">
        <h3 class="text-2xl font-semibold mb-4">Adicionar Novo Serviço</h3>
        <form id="createForm">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nome do Serviço</label>
                <input type="text" id="name" name="name" placeholder="Nome do serviço" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Preço (R$)</label>
                <input type="number" step="0.01" id="price" name="price" placeholder="Preço do serviço" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="time" class="block text-gray-700 font-medium mb-2">Tempo de Execução (minutos)</label>
                <input type="number" id="time" name="time" placeholder="Tempo em minutos" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-[#5C4033] text-[#F4E1C1] px-4 py-2 rounded hover:bg-[#3e2c22]">
                Adicionar Serviço
            </button>
        </form>
    </div>

    <!-- Tabela de listagem de serviços -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Lista de Serviços</h3>
        <table class="table-auto w-full text-left">
            <thead>
            <tr class="bg-[#5C4033] text-[#F4E1C1]">
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Tempo</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($services as $service): ?>
                <tr class="bg-gray-100 border-b">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($service['name']); ?></td>
                    <td class="px-4 py-2">R$ <?php echo number_format($service['price'], 2, ',', '.'); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($service['time']); ?> minutos</td>
                    <td class="px-4 py-2 space-x-2">
                    <!-- Botão para editar -->
                    <a href="/admin/services/edit/<?php echo $service['id']; ?>"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700">Editar</a>
                    <!-- Botão para deletar -->
                    <button type="button" 
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 delete-button" 
                            data-id="<?php echo $service['id']; ?>">
                        Deletar
                    </button>
                    </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    function cadastrarService(event) {
        event.preventDefault(); // Impede o recarregamento da página.

        const form = document.getElementById('createForm');
        const formData = new FormData(form);

        fetch('/admin/services/create', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: data.message || 'Cadastro realizado com sucesso!',
                    }).then(() => {
                        // Recarrega a tabela ou página para refletir a adição
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: data.message || 'Erro no cadastro!'
                    });
                }
            })
            .catch(error => {
                alert('Erro na requisição: ' + error);
            });
    }

    // Adiciona o evento ao botão de submissão do formulário
    document.getElementById('createForm').addEventListener('submit', cadastrarService);

    function deleteService(serviceId) {
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Esta ação não poderá ser desfeita!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/services/delete/${serviceId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Excluído!',
                            data.message || 'O serviço foi excluído com sucesso.',
                            'success'
                        ).then(() => {
                            // Recarrega a página para atualizar a tabela
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Erro!',
                            data.message || 'Erro ao excluir o serviço.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Erro!',
                        'Erro na requisição: ' + error,
                        'error'
                    );
                });
            }
        });
    }

    // Adiciona o evento de exclusão a todos os botões de exclusão
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', () => {
            const serviceId = button.getAttribute('data-id');
            deleteService(serviceId);
        });
    });
</script>


</body>

</html>
