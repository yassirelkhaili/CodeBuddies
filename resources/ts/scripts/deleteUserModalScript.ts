document.addEventListener("DOMContentLoaded", (): void => {
    const handleUserProfileDeleteModal = (): void => {
        const openButton: HTMLElement = document.getElementById("delete-user-button");
        const deleteModal: HTMLElement = document.getElementById("delete-user-modal");
    
        const toggleModal = (): void => {
            deleteModal && deleteModal.classList.add("")
        }

        openButton && openButton.addEventListener("click", toggleModal);
    }

    handleUserProfileDeleteModal();
})