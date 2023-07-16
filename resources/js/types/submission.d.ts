import type { Investor } from './investor'

export interface SubmissionFormProps {
    [key: string]: unknown
    firstName: string
    middleName: string
    lastName: string
    address: string
    contactNo: string
    email: string
    age?: number
    referralCode?: string
    occupation: {
        type: Occupation['type'] | ''
        data: Occupation['data']
    }
    initialInvestment: InitialInvestment
    validId?: File
    proofOfPayment?: File
}

export interface Submission extends SubmissionFormProps {
    id: string
    fullName: string
    status: string
    referredBy?: Investor
}

export type SubmissionAction = 'approve' | 'reject'

export interface InitialInvestment {
    paymentMethod: string
    amount?: number
    referenceNumber: string
}

export interface Occupation {
    type: 'student' | 'working'
    data: SchoolDetails & CompanyDetails
}

export interface SchoolDetails {
    name: string
    address: string
    contactNo: string
    courseYear: string
}

export interface CompanyDetails {
    name: string
    address: string
    contactNo: string
    position: string
    workYears?: number
}
