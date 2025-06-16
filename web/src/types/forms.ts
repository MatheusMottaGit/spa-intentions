export interface LoginForm {
  name: string
  pin: string
}

export interface LoginErrors {
  name?: string
  pin?: string
}

export interface IntentionForm {
  mass_date: string;
  mass_hour: string;
  church_id: number | null;
  contents: string[];
}