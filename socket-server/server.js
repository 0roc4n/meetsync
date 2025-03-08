const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

// Store active rooms
const rooms = new Map();

io.on('connection', (socket) => {
    console.log('A user connected');

    // Handle joining room
    socket.on('join', ({ role, meetingId, managerId }) => {
        const roomId = `meeting_${meetingId}_${managerId}`;
        socket.join(roomId);
        console.log(`${role} joined room: ${roomId}`);
    });

    // Handle note updates
    socket.on('update_note', ({ meetingId, managerId, content }) => {
        const roomId = `meeting_${meetingId}_${managerId}`;
        io.in(roomId).emit('note_updated', content); // Changed to io.in()
    });

    // Handle summary updates
    socket.on('update_summary', ({ meetingId, managerId, content }) => {
        const roomId = `meeting_${meetingId}_${managerId}`;
        io.in(roomId).emit('summary_updated', content); // Changed to io.in()
    });

    // Handle conversation updates
    socket.on('from_client_convo_update', ({ meetingId, managerId, content }) => {
        const roomId = `meeting_${meetingId}_${managerId}`;
        io.in(roomId).emit('conversation_updated', content); // Changed to io.in()
    });

    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

const PORT = process.env.PORT || 3001; // Changed from 3000 to 3001
http.listen(PORT, () => {
    console.log(`Socket.IO server running on port ${PORT}`);
});
