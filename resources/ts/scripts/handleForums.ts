/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import { reAttachForumEventListeners } from "../helpers";
import forumService from "../services/forumService";
import { toggleforumModal } from "./createForumModalScript";
import { toggleForumEditModal } from "./editForumModalScript";

export const handleForumCreation = (): void => {
    const createModal = document.querySelector(
        ".create-forum-form"
    ) as HTMLFormElement;
    createModal && createModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await forumService.createForum(
                        formProps
                    );
                    document.getElementById("search-results").innerHTML = response;
                    toggleforumModal();
                    reAttachForumEventListeners();
                });
};

handleForumCreation();

export const handleForumforumDeleteAction = (): void => {
    const editButtons = document.querySelectorAll(".delete-forum-button") as NodeListOf<HTMLButtonElement>;
    editButtons && editButtons.forEach((deleteButton: HTMLButtonElement): void => {
        deleteButton && deleteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as HTMLButtonElement;
            const forumId: string = eventTarget.getAttribute("data-forum-id");
            const response: string = await forumService.deleteForum(forumId);
            document.getElementById("search-results").innerHTML = response;
            reAttachForumEventListeners();
        })
    })
};

handleForumforumDeleteAction();

export const handleforumEditAction = (): void => {
    const editModal = document.querySelector(
        ".edit-forum-form"
    ) as HTMLFormElement;
    editModal && editModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const forumId = eventTarget.getAttribute("data-forum-id");
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await forumService.editForum(
                        forumId,
                        formProps
                    );
                    document.getElementById("search-results").innerHTML = response;
                    reAttachForumEventListeners();
                    toggleForumEditModal();
                });
};

handleforumEditAction();
