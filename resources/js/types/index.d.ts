export interface User {
    id: number;
    firstName: string;
    middleName: string;
    lastName: string;
    fullName: string;
    initials: string;
    email: string;
    contactNo: string;
    photo: string;
    role: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    user: User;
};

export interface LazyTableProps<T> {
    items: Array<T>;
    total: number;
}
