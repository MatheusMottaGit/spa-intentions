export type UserRole = 'admin' | 'user';

export interface User {
  id: string;
  name: string;
  pin: string;
  role: UserRole;
}

export interface Church {
  id: number; 
  name: string;
}

export interface Intention {
  id: number;
  mass_date: string;
  contents: string[];
  church: Church;
  user: {
    id: string;
    name: string;
  };
}

export type IntentionGroup = Record<string, Intention[]>; 