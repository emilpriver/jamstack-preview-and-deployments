console.log('hello')

const deployElements = document.querySelectorAll('.nextjs-preview-deploy-button');
console.log(deployElements)
window.onload = function() {
    deployElements.forEach(item => {
        item.addEventListener("click", function () {
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'nextjs_preview_deploy_website'
                })
            })
        });
    })
}