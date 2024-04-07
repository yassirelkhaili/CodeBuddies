document.addEventListener("DOMContentLoaded", (): void => {
    const handleUserProfileDeleteModal = (): void => {
        const openButton = document.getElementById("delete-user-button") as HTMLButtonElement;
        const cancelButton = document.getElementById("cancel-delete-modal") as HTMLButtonElement;
        const deleteModal = document.getElementById("delete-user-form") as HTMLButtonElement;
        const actionButtons: Array<HTMLButtonElement> = [openButton, cancelButton];
        let isDeleteModalOpen: boolean = false;

        const toggleModal = (event: MouseEvent = null): void => {
            if (event !== null) event.stopPropagation();
            if (deleteModal) {
                deleteModal.classList.toggle("hidden");
                deleteModal.parentElement.parentElement.classList.toggle("hidden");
                isDeleteModalOpen = !isDeleteModalOpen;
            }
        };

        document.addEventListener("click", (event: MouseEvent): void => {
            const eventTarget = event.target as HTMLElement;
            (!deleteModal.contains(eventTarget) && isDeleteModalOpen) && toggleModal();
        });

        actionButtons.forEach((actionButton: HTMLButtonElement): void => {
            actionButton && actionButton.addEventListener("click", toggleModal);
        });
    };

    handleUserProfileDeleteModal();
});