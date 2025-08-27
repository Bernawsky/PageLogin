// 🔧 Configuração do Supabase
const SUPABASE_URL = 'https://YOUR_PROJECT_ID.supabase.co';
const SUPABASE_KEY = 'YOUR_PUBLIC_ANON_KEY';

const headers = {
  'Content-Type': 'application/json',
  'apikey': SUPABASE_KEY,
  'Authorization': `Bearer ${SUPABASE_KEY}`
};

// 🔹 Criar conta
document.querySelector('.form-SignUp').addEventListener('submit', async (e) => {
  e.preventDefault();

  const name = document.getElementById('username').value;
  const email = document.querySelector('.form-SignUp #email').value;
  const password = document.getElementById('password').value;

  const response = await fetch(`${SUPABASE_URL}/rest/v1/users`, {
    method: 'POST',
    headers,
    body: JSON.stringify({ name, email, password })
  });

  const result = await response.json();

  if (!response.ok) {
    showModal('Erro ao criar conta: ' + (result.message || 'Verifique os dados.'));
  } else {
    showModal('Conta criada com sucesso!');
  }
});

// 🔹 Login
document.querySelector('.form-SignIn').addEventListener('submit', async (e) => {
  e.preventDefault();

  const emailOrName = document.querySelector('.form-SignIn #email').value;
  const password = document.getElementById('Password').value;

  const query = `or=(email.eq.${emailOrName},name.eq.${emailOrName})&password=eq.${password}`;
  const response = await fetch(`${SUPABASE_URL}/rest/v1/users?select=*&${query}`, {
    method: 'GET',
    headers
  });

  const result = await response.json();

  if (!response.ok || result.length === 0) {
    showModal('Erro ao fazer login: credenciais inválidas');
  } else {
    showModal('Login realizado com sucesso!');
    // Aqui você pode redirecionar ou carregar conteúdo
  }
});

// 🔹 Modal de erro/sucesso
function showModal(message) {
  const modal = document.createElement('div');
  modal.className = 'modal';
  modal.innerHTML = `
    <div class="modal-content">
      <p>${message}</p>
      <button onclick="this.parentElement.parentElement.remove()">Fechar</button>
    </div>`;
  document.body.appendChild(modal);
}