/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import { togglethreadModal } from "./createThreadModalScript";
import threadService from "../services/threadService";
import extractForumIdFromUrl, { reAttachThreadEventListeners } from "../helpers";
import { toggleThreadEditModal } from "./editThreadModalScript";

export const handleThreadCreation = (): void => {
    const createModal = document.querySelector(
        ".create-thread-form"
    ) as HTMLFormElement;
    createModal && createModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const forumId: string = extractForumIdFromUrl();
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await threadService.createThread(
                        forumId,
                        formProps
                    );
                    document.getElementById("filter-results-threads").innerHTML = response;
                    reAttachThreadEventListeners();
                    togglethreadModal();
                });
};

handleThreadCreation();

export const handleThreadDeleteAction = (): void => {
    const editButtons = document.querySelectorAll(".delete-thread-button") as NodeListOf<HTMLButtonElement>;
    editButtons && editButtons.forEach((deleteButton: HTMLButtonElement): void => {
        deleteButton && deleteButton.addEventListener("click", async (event: MouseEvent): Promise<void> => {
            event.stopPropagation();
            const eventTarget = event.currentTarget as HTMLButtonElement;
            const threadId: string = eventTarget.getAttribute("data-thread-id");
            const response: string = await threadService.deleteThread(threadId);
            document.getElementById("filter-results-threads").innerHTML = response;
            reAttachThreadEventListeners()
        })
    })
};

handleThreadDeleteAction();

export const handleThreadEditAction = (): void => {
    const editModal = document.querySelector(
        ".edit-thread-form"
    ) as HTMLFormElement;
    editModal && editModal.addEventListener("submit", async (event: SubmitEvent): Promise<void> => {
                    event.preventDefault();
                    const eventTarget = event.target as HTMLFormElement;
                    const threadId = eventTarget.getAttribute("data-thread-id");
                    const formData = new FormData(eventTarget);
                    const formProps: Record<string, any> = {};
                    formData.forEach((value, key) => {
                        formProps[key] = value;
                    });
                    const response: string = await threadService.editThread(
                        threadId,
                        formProps
                    );
                    document.getElementById("filter-results-threads").innerHTML = response;
                    reAttachThreadEventListeners();
                    toggleThreadEditModal();
                });
};

handleThreadEditAction();
