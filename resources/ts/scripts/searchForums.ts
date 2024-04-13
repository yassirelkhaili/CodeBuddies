/** 
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

import searchService from "../services/searchService";

document.addEventListener("DOMContentLoaded", (): void => {
    const handleForumSearchAction = (): void => {
        const form = document.getElementById('search-form') as HTMLFormElement;
        if (form) {
            form.addEventListener("submit", async (event: Event): Promise<void> => {
                event.preventDefault();
                const searchInput = document.getElementById('default-search') as HTMLInputElement;
                if (searchInput) {
                    const searchValue: string = searchInput.value.trim();
                    const response: string = await searchService.handleForumSearch(searchValue);
                    document.getElementById("search-results").innerHTML = response;
                }
            });
        }
    };

    handleForumSearchAction();
});
