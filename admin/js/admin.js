window.onload = function () {
    document.querySelectorAll('.nextjs-preview-deploy-button').forEach(item => {
        item.addEventListener("click", function () {
            let formData = new FormData();
            formData.append('action', 'nextjs_preview_deploy_website');

            fetch(ajaxurl, {
                method: 'POST',
                body: formData
            })
        });
    })
}