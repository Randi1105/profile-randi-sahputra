document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('chat-form');
    const input = document.getElementById('message-input');
    const chatContainer = document.getElementById('chat-container');
    const templates = {
        user: document.getElementById('user-msg-template'),
        ai: document.getElementById('ai-msg-template'),
        loading: document.getElementById('loading-template')
    };

    function appendMessage(type, text) {
        const clone = templates[type].content.cloneNode(true);
        const contentDiv = clone.querySelector('.message-content');

        // Simple Markdown-like parsing for bold text
        const parsedText = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\n/g, '<br>');

        contentDiv.innerHTML = parsedText;
        chatContainer.appendChild(clone);
        scrollToBottom();
    }

    function showLoading() {
        const clone = templates.loading.content.cloneNode(true);
        chatContainer.appendChild(clone);
        scrollToBottom();
    }

    function removeLoading() {
        const loader = document.getElementById('loading-indicator');
        if (loader) loader.remove();
    }

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        // UI Updates
        appendMessage('user', message);
        input.value = '';
        input.disabled = true; // Disable input while waiting
        showLoading();

        try {
            const response = await fetch('/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message })
            });

            removeLoading();
            const data = await response.json();

            if (data.reply) {
                appendMessage('ai', data.reply);
            } else {
                appendMessage('ai', "Maaf, terjadi kesalahan yang tidak diketahui.");
            }

        } catch (error) {
            removeLoading();
            appendMessage('ai', "Maaf, gagal terhubung ke server.");
            console.error(error);
        } finally {
            input.disabled = false;
            input.focus();
        }
    });
});
