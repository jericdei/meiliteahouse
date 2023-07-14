import { User } from './user'

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    user: User
}

export interface LazyTableProps<T> {
    items: Array<T>
    total: number
}

export type UnionOmit<T, K extends PropertyKey> = T extends unknown
    ? Omit<T, K>
    : never
