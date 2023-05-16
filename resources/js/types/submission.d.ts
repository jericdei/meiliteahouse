export interface Submission {
    firstName: string
    middleName: string
    lastName: string
    contactNo: string
    email: string
    age: number
    referralCode: string
    profilePicture: File
    occupationType: string
    occupationData: Object
    paymentMethod: string
    initialInvestment: number
    referenceNumber: string
    validId: File
    proofOfPayment: File
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
    workYears: number
}
