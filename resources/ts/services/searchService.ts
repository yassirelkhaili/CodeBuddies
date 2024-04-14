import axios from "axios";

class SearchService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/forums" || "";

    public async handleForumSearch(searchInput: string): Promise<string> {
        try {
            const response = await axios.get<string>(`${this.BASE_URL}/search`, {
                params: { query: searchInput },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            });
            return response.data;
        } catch (error) {
            console.error("An error has occured:", error);
            throw error;
        }
    }

    public async handleThreadFilter(filterInput: string, forumId: string): Promise<string> {
        try {
            const response = await axios.get<string>(`${this.BASE_URL}/${forumId}/threads/filter`, {
                params: { query: filterInput },
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            });
            return response.data;
        } catch (error) {
            console.error("An error has occured:", error);
            throw error;
        }
    }
}

const searchService = new SearchService();

export default searchService;
