window.onload = function () {
    document.querySelectorAll('.nextjs-preview-deploy-button').forEach(item => {
        item.addEventListener("click", function () {
            let formData = new FormData();
            formData.append('action', 'nextjs_preview_deploy_website');

            item.innerHTML = '<div class="ab-item ab-empty-item">Sending Deploy</div>'
            fetch(ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(() => {
                item.innerHTML = '<div class="ab-item ab-empty-item">Deployment sent</div>'
            })
            .catch(() => {
                item.innerHTML = '<div class="ab-item ab-empty-item">Error sending deploy</div>'
            })
        });
    })
}