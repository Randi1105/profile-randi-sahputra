require('dotenv').config();
const express = require('express');
const { GoogleGenerativeAI } = require("@google/generative-ai");
const path = require('path');
const app = express();

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// Initialize Gemini API (only if key is present)
let genAI;
let model;
if (process.env.GEMINI_API_KEY) {
    try {
        genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);
        // Using gemini-1.5-flash to avoid 404 errors with newer API clients
        model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
    } catch (e) {
        console.error("Failed to initialize Gemini API Client:", e);
    }
}

app.get('/', (req, res) => res.render('index'));

app.post('/chat', async (req, res) => {
    if (!process.env.GEMINI_API_KEY) {
        return res.status(500).json({ reply: "API Key belum dikonfigurasi di server (.env)." });
    }

    try {
        const userMessage = req.body.message;
        const result = await model.generateContent(userMessage);
        const response = await result.response;
        const text = response.text();
        res.json({ reply: text });
    } catch (error) {
        console.error("Gemini API Error:", error);
        res.status(500).json({ reply: "Maaf, ada gangguan koneksi ke AI atau kuota habis." });
    }
});

app.listen(4001, () => console.log('Chatbot running on http://localhost:4001'));
