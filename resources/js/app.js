import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.start();

// Custom Confirmation Dialog dengan styling Kaira
window.kairaConfirm = function(message, title = 'Konfirmasi') {
    return new Promise((resolve) => {
        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'kaira-modal-overlay';
        overlay.id = 'kaira-modal-overlay';
        
        // Create modal
        const modal = document.createElement('div');
        modal.className = 'kaira-modal';
        
        // Modal header
        const header = document.createElement('div');
        header.className = 'kaira-modal-header';
        const titleEl = document.createElement('h3');
        titleEl.className = 'kaira-modal-title';
        titleEl.textContent = title;
        header.appendChild(titleEl);
        
        // Modal body
        const body = document.createElement('div');
        body.className = 'kaira-modal-body';
        body.innerHTML = message.replace(/\n/g, '<br>');
        
        // Modal footer
        const footer = document.createElement('div');
        footer.className = 'kaira-modal-footer';
        
        // Cancel button
        const cancelBtn = document.createElement('button');
        cancelBtn.className = 'kaira-modal-btn kaira-modal-btn-secondary';
        cancelBtn.textContent = 'Batal';
        cancelBtn.type = 'button';
        cancelBtn.onclick = () => {
            document.body.removeChild(overlay);
            resolve(false);
        };
        
        // OK button
        const okBtn = document.createElement('button');
        okBtn.className = 'kaira-modal-btn kaira-modal-btn-primary';
        okBtn.textContent = 'OK';
        okBtn.type = 'button';
        okBtn.onclick = () => {
            document.body.removeChild(overlay);
            resolve(true);
        };
        
        footer.appendChild(cancelBtn);
        footer.appendChild(okBtn);
        
        // Assemble modal
        modal.appendChild(header);
        modal.appendChild(body);
        modal.appendChild(footer);
        overlay.appendChild(modal);
        
        // Add to body
        document.body.appendChild(overlay);
        
        // Trigger animation
        setTimeout(() => {
            overlay.classList.add('show');
        }, 10);
        
        // Close on overlay click
        overlay.onclick = (e) => {
            if (e.target === overlay) {
                document.body.removeChild(overlay);
                resolve(false);
            }
        };
        
        // Close on Escape key
        const escapeHandler = (e) => {
            if (e.key === 'Escape') {
                document.body.removeChild(overlay);
                document.removeEventListener('keydown', escapeHandler);
                resolve(false);
            }
        };
        document.addEventListener('keydown', escapeHandler);
    });
};

// Helper function untuk onsubmit dengan confirm
window.kairaConfirmSubmit = function(event, message, title = 'Konfirmasi') {
    event.preventDefault();
    const form = event.target;
    kairaConfirm(message, title).then(result => {
        if (result) {
            form.submit();
        }
    });
    return false;
};

// Helper function untuk onclick dengan confirm
window.kairaConfirmClick = function(event, message, title = 'Konfirmasi', callback) {
    event.preventDefault();
    kairaConfirm(message, title).then(result => {
        if (result && callback) {
            callback();
        }
    });
    return false;
};

// Global Toggle Password Function
window.togglePassword = function(inputId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById('eye-' + inputId);
    const eyeOff = document.getElementById('eye-off-' + inputId);
    
    if (!input || !eye || !eyeOff) {
        console.warn('Toggle password: Element not found for', inputId);
        return;
    }
    
    // Toggle input type
    if (input.type === 'password') {
        // Show password
        input.type = 'text';
        eye.style.display = 'none';
        eyeOff.style.display = 'block';
        // Also handle classList for Tailwind compatibility
        if (eye.classList) eye.classList.add('hidden');
        if (eyeOff.classList) eyeOff.classList.remove('hidden');
    } else {
        // Hide password
        input.type = 'password';
        eye.style.display = 'block';
        eyeOff.style.display = 'none';
        // Also handle classList for Tailwind compatibility
        if (eye.classList) eye.classList.remove('hidden');
        if (eyeOff.classList) eyeOff.classList.add('hidden');
    }
};

// Custom Alert Dialog dengan styling Kaira (hanya OK button)
window.kairaAlert = function(message, title = 'Informasi') {
    return new Promise((resolve) => {
        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'kaira-modal-overlay';
        overlay.id = 'kaira-modal-overlay';
        
        // Create modal
        const modal = document.createElement('div');
        modal.className = 'kaira-modal';
        
        // Modal header
        const header = document.createElement('div');
        header.className = 'kaira-modal-header';
        const titleEl = document.createElement('h3');
        titleEl.className = 'kaira-modal-title';
        titleEl.textContent = title;
        header.appendChild(titleEl);
        
        // Modal body
        const body = document.createElement('div');
        body.className = 'kaira-modal-body';
        body.innerHTML = message.replace(/\n/g, '<br>');
        
        // Modal footer
        const footer = document.createElement('div');
        footer.className = 'kaira-modal-footer';
        
        // OK button
        const okBtn = document.createElement('button');
        okBtn.className = 'kaira-modal-btn kaira-modal-btn-primary';
        okBtn.textContent = 'OK';
        okBtn.type = 'button';
        okBtn.onclick = () => {
            document.body.removeChild(overlay);
            resolve(true);
        };
        
        footer.appendChild(okBtn);
        
        // Assemble modal
        modal.appendChild(header);
        modal.appendChild(body);
        modal.appendChild(footer);
        overlay.appendChild(modal);
        
        // Add to body
        document.body.appendChild(overlay);
        
        // Trigger animation
        setTimeout(() => {
            overlay.classList.add('show');
        }, 10);
        
        // Close on overlay click
        overlay.onclick = (e) => {
            if (e.target === overlay) {
                document.body.removeChild(overlay);
                resolve(true);
            }
        };
        
        // Close on Escape key
        const escapeHandler = (e) => {
            if (e.key === 'Escape') {
                document.body.removeChild(overlay);
                document.removeEventListener('keydown', escapeHandler);
                resolve(true);
            }
        };
        document.addEventListener('keydown', escapeHandler);
    });
};
