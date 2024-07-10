const express = require('express');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

let users = {};  // 儲存用戶資訊的物件

app.post('/register', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;

    if (users[username]) {
        res.status(400).send('Username already exists');
    } else {
        users[username] = password;
        res.status(200).send('Registration successful');
    }
});

app.post('/login', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;

    if (users[username] === password) {
        res.status(200).send('Login successful');
    } else {
        res.status(401).send('Invalid username or password');
    }
});

app.listen(3000, () => {
    console.log('Server is running on port 3000');
});
