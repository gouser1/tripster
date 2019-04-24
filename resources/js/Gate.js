export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === 'admin';
    }

    isUser() {
        return this.user.type === 'user';
    }

    isAdminOrDriver() {
        if (this.user.type === 'admin' || this.user.type === 'driver') {
            return true;
        }
    }

    isInParty() {
        if (this.user.party_id !== null) {
            return true;
        }
    }

    isNotInParty() {
        if (this.user.party_id === null) {
            return true;
        }
    }


}
