export default function extractForumIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[2];
}

export function extractThreadIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[3];
}

export function extractPostIdFromUrl (): string {
    const pathname: string = window.location.pathname;
    return pathname.split('/')[4];
}