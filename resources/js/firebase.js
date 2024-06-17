import firebase from 'firebase/app';
import "firebase/firestore";

const config = {
    apiKey: process.env.MIX_FIREBASE_API_KEY,
    authDomain: process.env.MIX_FIREBASE_AUTH_DOMAIN,
    databaseURL: process.env.MIX_FIREBASE_DATABASE_URL,
    projectId: process.env.MIX_FIREBASE_PROJECT_ID,
    storageBucket: process.env.MIX_FIREBASE_STORAGE_BUCKET,
    messagingSenderId: "694488500848",
    appId: process.env.MIX_FIREBASE_APP_ID
};
firebase.initializeApp(config);

export default firebase;