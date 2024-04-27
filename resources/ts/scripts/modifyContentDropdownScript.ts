/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/
import postService from "../services/postService";

export enum ContentType {
    THREAD = "thread",
    POST = "post",
    FORUM = "forum"
}

export const handleDropDownToggle = (contentType: ContentType) => {
    const toggleButtons = document.querySelectorAll(".dropdown-toggle-button") as NodeListOf<SVGAElement>;
    toggleButtons && toggleButtons.forEach((toggleButton: SVGElement): void => {
        toggleButton && toggleButton.addEventListener("click", (event: MouseEvent): void => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as SVGAElement;
            const contentId: string = eventTarget.hasAttribute(`data-${contentType}-id`) ? eventTarget.getAttribute(`data-${contentType}-id`) : "";
            const dropdown = document.getElementById(`dropdown${contentId}`);
            dropdown && dropdown.classList.toggle("hidden");
            const handleOutsideClick = () => {
                document.addEventListener("click", (event: MouseEvent): void => {
                    const currentTarget = event.target as HTMLElement;
                    if (dropdown && !dropdown.contains(currentTarget)) {
                        dropdown.classList.toggle("hidden");
                    }
                })
            }
            handleOutsideClick();
        })
    })
}

handleDropDownToggle(ContentType.POST);
handleDropDownToggle(ContentType.FORUM);
handleDropDownToggle(ContentType.THREAD);
 