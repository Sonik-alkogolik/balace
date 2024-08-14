document.addEventListener('DOMContentLoaded', function() {
    const openDocumentButtons = document.querySelectorAll('.open-document');

    openDocumentButtons.forEach(button => {
        button.addEventListener('click', function() {
            const licenseItem = this.closest('.licenses-item');
            const imgElement = licenseItem.querySelector('.licenses-item-img img');
            
            if (imgElement) {
                const fullScreenDiv = document.createElement('div');
                fullScreenDiv.style.position = 'fixed';
                fullScreenDiv.style.top = '0';
                fullScreenDiv.style.left = '0';
                fullScreenDiv.style.width = '100%';
                fullScreenDiv.style.height = '100%';
                fullScreenDiv.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
                fullScreenDiv.style.display = 'flex';
                fullScreenDiv.style.alignItems = 'center';
                fullScreenDiv.style.justifyContent = 'center';
                fullScreenDiv.style.cursor = 'zoom-out';
                fullScreenDiv.style.zIndex = '1000';

                const fullScreenImg = document.createElement('img');
                fullScreenImg.src = imgElement.src;
                fullScreenImg.style.width = '60%';
                fullScreenImg.style.height = '90%';

                fullScreenDiv.appendChild(fullScreenImg);
                document.body.appendChild(fullScreenDiv);

                fullScreenDiv.addEventListener('click', function() {
                    document.body.removeChild(fullScreenDiv);
                });
            }
        });
    });
});