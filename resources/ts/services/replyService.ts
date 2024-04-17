import axios from "axios";

class ReplyService {
    private BASE_URL = import.meta.env.VITE_APP_URL + "/replies" || "";

    public async handleReplySubmission(reply: string, postId: string): Promise<string> {
        try {
            const response = await axios.post<string>(`${this.BASE_URL}`, {reply: reply, post_id: postId});
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

const replyService = new ReplyService();

export default replyService;
