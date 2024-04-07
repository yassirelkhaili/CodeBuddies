/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

document.addEventListener("DOMContentLoaded", (): void => {
    const handleNewAvatarUploadPreview = (): void => {
        const avatarInput = document.getElementById("dropzone-file") as HTMLInputElement;
        const avatarPreview = document.getElementById("avatarImage") as HTMLImageElement;

        avatarInput && avatarInput.addEventListener("change", (event: Event): void => {
            const eventTarget = event.target as HTMLInputElement;
            if (eventTarget.files && eventTarget.files[0]) {
                var render = new FileReader();
                render.onload = (event: Event): void => {
                    const eventTarget = event.target as FileReader;
                    if (eventTarget.result) avatarPreview.src = eventTarget.result as string;
                };
                render.readAsDataURL(eventTarget.files[0]);
            };
        });
    };

    handleNewAvatarUploadPreview();
});