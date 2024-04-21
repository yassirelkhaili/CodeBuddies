import axios from "axios";

class PostService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/posts" || "";

    public async upvotePost(postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/upvote/${postId}`);
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }

    public async downvotePost(postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}/downvote/${postId}`);
            return response.data;
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response && error.response.status === 403) {
                    window.location.href = '/login';
                }
            }
            console.error("An error occurred:", error);
            throw error;
        }
    }
}

const postService = new PostService();

export default postService;
