<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>
    <h1>Bem-vindo ao chat!</h1>
    
    <!-- Formulário de chat -->
    <div id="chat-container">
        <div id="chat-messages">
            <!-- Mensagens do chat serão exibidas aqui -->
        </div>
        <form id="chat-form">
            <input type="text" id="message-input" placeholder="Digite sua mensagem...">
            <button type="submit">Enviar</button>
        </form>
    </div>

    <!-- Script para enviar mensagem via AJAX e atualizar o chat -->
    <script>
        // Função para enviar mensagem via AJAX
        document.getElementById('chat-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var messageInput = document.getElementById('message-input').value;
            sendMessage(messageInput);
        });

        function sendMessage(message) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Sucesso ao enviar mensagem
                        console.log(xhr.responseText);
                        // Atualiza o chat após o envio da mensagem
                        document.getElementById('message-input').value = '';
                        // Atualiza o chat após o envio da mensagem
                        updateChat();
                    } else {
                        // Erro ao enviar mensagem
                        console.error('Erro ao enviar mensagem: ' + xhr.status);
                    }
                }
            };
            xhr.send('message=' + encodeURIComponent(message));
        }

        // Função para atualizar o chat
        function updateChat() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_messages.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        // Sucesso ao receber mensagens do servidor
                        var messages = JSON.parse(xhr.responseText);
                        displayMessages(messages);
                    } else {
                        // Erro ao receber mensagens do servidor
                        console.error('Erro ao buscar mensagens: ' + xhr.status);
                    }
                }
            };
            xhr.send();
        }

        function displayMessages(messages) {
            var chatMessagesDiv = document.getElementById('chat-messages');
            // Limpa as mensagens existentes
            chatMessagesDiv.innerHTML = '';
            // Adiciona as novas mensagens à lista
            messages.forEach(function(message) {
                var messageElement = document.createElement('div');
                messageElement.textContent = message.username + ': ' + message.message;
                chatMessagesDiv.appendChild(messageElement);
            });
        }

        // Atualiza o chat a cada 5 segundos
        setInterval(updateChat, 5000); // Atualiza a cada 5 segundos
    </script>
     <!-- Botão de logout -->
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
