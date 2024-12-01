<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agenda-La - Serviços de Barbearia</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<div class="bg-[#F4E1C1] p-6 font-[sans-serif]">
		<div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
			<div class="max-w-md w-full">

				<div class="p-8 rounded-2xl bg-white shadow">
					<h2 class="text-gray-800 text-center text-2xl font-bold">Acessar o sistema</h2>
					<form class="mt-8 space-y-4" id="loginForm">
						<div>
							<label class="text-gray-800 text-sm mb-2 block">Email</label>
							<div class="relative flex items-center">
								<input name="email" type="text" required
									class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
									placeholder="Insira seu e-mail" />
							</div>
						</div>

						<div>
							<label class="text-gray-800 text-sm mb-2 block">Senha</label>
							<div class="relative flex items-center">
								<input name="password" type="password" required
									class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600"
									placeholder="Insira sua senha" />
							</div>
						</div>
						<div class="!mt-8">
							<button type="button" id="loginButton"
								class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-[#5C4033] focus:outline-none">
								Realizar Login
							</button>
						</div>
						<p class="text-gray-800 text-sm !mt-8 text-center">Não tem uma conta? <a href="javascript:void(0);"
								class="text-[#5C4033] hover:underline ml-1 whitespace-nowrap font-semibold">Se registre aqui</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		function loginUser() {
			const form = document.getElementById('loginForm');
			const formData = new FormData(form);

			fetch('/authenticate', {
				method: 'POST',
				body: formData
			})
				.then(response => response.json())
				.then(data => {
					if (data.status === 'success') {
						if (data.redirect) {
							window.location.href = data.redirect;
						}
						Swal.fire({
							icon: 'success',
							title: 'Successo!',
							text: data.message || 'Credenciais inválidas!',
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Erro!',
							text: data.message || 'Credenciais inválidas!',
						});
					}
				})
				.catch(error => {
					alert('Erro na requisição: ' + error);
				});
		}

		document.getElementById('loginButton').addEventListener('click', function () {
			loginUser();
		});
	</script>

</body>

</html>