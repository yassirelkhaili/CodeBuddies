/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import { extractPostIdFromUrl } from "../helpers";
import replyService from "../services/replyService";

document.addEventListener("DOMContentLoaded", (): void => {
    const handleReplyPostAction = (): void => {
        const form = document.getElementById('create-reply-form') as HTMLFormElement;
        if (form) {
            form.addEventListener("submit", async (event: Event): Promise<void> => {
                event.preventDefault();
                const searchInput = document.getElementById('reply-editor') as HTMLInputElement;
                if (searchInput) {
                    const searchValue: string = searchInput.value;
                    const postId: string = extractPostIdFromUrl();
                    const response: string = await replyService.handleReplySubmission(searchValue, postId);
                    document.getElementById("post-reply-results").innerHTML = response;
                }
            });
        }
    };

    handleReplyPostAction();
});