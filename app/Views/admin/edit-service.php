<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço - Agenda-la</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[#F4E1C1] font-sans leading-normal tracking-normal">

<header class="bg-[#5C4033] text-[#F4E1C1] p-6">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">
            <h1>Agenda-la - Editar Serviço</h1>
        </div>
        <nav class="space-x-4">
            <a href="/admin" class="hover:text-[#D3B18C]">Admin Home</a>
            <a href="/admin/users" class="hover:text-[#D3B18C]">Usuários</a>
        </nav>
    </div>
</header>

<section class="container mx-auto py-10">
    <h2 class="text-3xl font-semibold mb-6">Editar Serviço</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Editar Serviço</h3>
        <form id="editForm">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nome do Serviço</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($service['name']); ?>" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Preço (R$)</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="time" class="block text-gray-700 font-medium mb-2">Tempo de Execução (minutos)</label>
                <input type="number" id="time" name="time" value="<?php echo htmlspecialchars($service['time']); ?>" required
                       class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-[#5C4033] text-[#F4E1C1] px-4 py-2 rounded hover:bg-[#3e2c22]">
                Atualizar Serviço
            </button>
        </form>
    </div>
</section>

<script>
    function editarService(event) {
        event.preventDefault(); // Impede o recarregamento da página.

        const form = document.getElementById('editForm');
        const formData = new FormData(form);

        fetch('/admin/services/update/<?php echo $service['id']; ?>', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: data.message || 'Serviço atualizado com sucesso!',
                    }).then(() => {
                        // Recarrega a página ou redireciona para a lista
                        window.location.href = '/admin/services';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: data.message || 'Erro ao atualizar o serviço!'
                    });
                }
            })
            .catch(error => {
                alert('Erro na requisição: ' + error);
            });
    }

    document.getElementById('editForm').addEventListener('submit', editarService);
</script>

</body>
</html>