export interface User {
    id: number
    firstName: string
    middleName: string
    lastName: string
    fullName: string
    initials: string
    email: string
    contactNo: string
    role: Role
    createdAt: string
    updatedAt: string
}

export type Role = 'admin' | 'investor'
