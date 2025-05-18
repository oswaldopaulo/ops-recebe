# OPS-System!

Um sistema via browser criado a fim de estudo de inteligência artificial para desenvolvimento web,  
Programação e ferramentas utilizada: #php8.2 #laravel 12 #livewire #alpinejs #jquery  #bootstrap 5, #sbadmin, #openai, junie jetbrains

- Instalação
  Configure para seu banco de dados em config/app.php ou no crie o arquivo .env com base .env.example.
  Configure para seu email em config/mail.php ou no crie o arquivo .env com base .env.example.

Execute os comandos no diretorio clonado

    composer update
    php artisan migrate
    php artisan db:seed
Usuario: test
Senha: test


## Base

- Registra Usuário.
- Autenticação de usuário por email, documento e username.
- Manutenção de profile do usuário.
- Recuperação de senha por email.
- Verificação de conta por email.

