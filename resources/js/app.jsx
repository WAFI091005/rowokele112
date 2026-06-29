// import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import AnggotaList from './components/AnggotaList';

const rootElement = document.getElementById('anggota-root');
if (rootElement) {
    const dataAnggota = JSON.parse(rootElement.getAttribute('data-anggota') || '[]');
    
    // Menggunakan React.createElement menggantikan sintaks tag < >
    ReactDOM.createRoot(rootElement).render(
        React.createElement(React.StrictMode, null, 
            React.createElement(AnggotaList, { anggota: dataAnggota })
        )
    );
}