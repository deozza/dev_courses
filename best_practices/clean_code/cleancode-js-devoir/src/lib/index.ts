
import weapons from './weaponList.json';

export let weaponList: any[] = [];

export function init() {
    weaponList = weapons;


    let playerMaxHealth = 10;
    let playerCurrentHealth = 10;
    let enemyMaxHealth = 10;
    let enemyCurrentHealth = 10;
    let playerWeapon = weaponList[Math.floor(Math.random() * weaponList.length)];
    let enemyWeapon = null;
    let hasInit = true;
    let hasRound = true;
    let hasFought = false;
    let playerWon = false;
    let playerLost = false;

    weaponList = weapons;

    return {
        playerMaxHealth,
        playerCurrentHealth,
        enemyMaxHealth,
        enemyCurrentHealth,
        playerWeapon,
        enemyWeapon,
        hasInit,
        hasRound,
        hasFought,
        playerWon,
        playerLost
    }
}

export function newRound(hasInit: boolean) {
    if(hasInit) {
        weaponList = weapons;

        return {
            playerWeapon: weaponList[Math.floor(Math.random() * weaponList.length)],
            enemyWeapon: null,
            hasRound: true,
            hasFought: false
        }
    } else {
        throw new Error('Game not initialized');
    }
}

export function fight(playerHealth: number, enemyHealth: number, playerWeapon: any, hasInit: boolean, hasRound: boolean, hasFought: boolean): Array<number|boolean> {
    
    if(hasInit){
        if(hasRound){
            if(!hasFought) {
    
                let playerDamages: number = 0;
                let enemyDamages: number = 0;
            
                switch (playerWeapon.name) {
                    case 'hatchet':
                    case 'knife':
                    case 'spear':
                        playerDamages += 1;
                        break;
                    case 'sword':
                    case 'halberd': 
                        playerDamages += 5;
                        break;
                    case 'bow':
                        playerDamages += 1 * (Math.floor(Math.random() * 5));
                        break;
                    case 'crossbow':
                        playerDamages += 2 * (Math.floor(Math.random() * 5));
                        break
                    case 'darts':
                        playerDamages += 1 * (Math.floor(Math.random() * 3));
                        break;
                    case 'dagger':
                        playerDamages += 3;
                        break;
                    default:
                        throw new Error('Invalid weapon');
                }
            
                // reset weapon list so the enemy could play
                weaponList = weapons;
            
                let enemyWeapon = weaponList[Math.floor(Math.random() * weaponList.length)];
            
                switch (enemyWeapon.name) {
                    case 'hatchet':
                    case 'knife':
                    case 'spear':
                        enemyDamages += 1;
                        break;
                    case 'sword':
                    case 'halberd': 
                        enemyDamages += 5;
                        break;
                    case 'bow':
                        enemyDamages += 1 * (Math.floor(Math.random() * 5));
                        break;
                    case 'crossbow':
                        enemyDamages += 2 * (Math.floor(Math.random() * 5));
                        break
                    case 'darts':
                        enemyDamages += 1 * (Math.floor(Math.random() * 3));
                        break;
                    case 'dagger':
                        enemyDamages += 3;
                        break;
                    default:
                        throw new Error('Invalid weapon');
                }

                if(playerDamages === enemyDamages) {
                    return [playerHealth, enemyHealth];
                }
            
                if(playerDamages > enemyDamages) {
                    enemyHealth -= playerDamages - enemyDamages;
                } else {
                    playerHealth -= enemyDamages - playerDamages;
                }
           
                // health cannot be negative
                if(playerHealth <= 0) {
                    playerHealth = 0;
                }
            
                // health cannot be negative
                if(enemyHealth <= 0) {
                    enemyHealth = 0;
                }
                
                // check if the game is over and the player has won
                if(enemyHealth === 0) {
                    return [playerHealth, enemyHealth, enemyWeapon, true, true, false];
                }


                // check if the game is over and the player has lost
                if(playerHealth === 0) {
                    return [playerHealth, enemyHealth, enemyWeapon, true, false, true];
                }
            
                return [playerHealth, enemyHealth, enemyWeapon, true, false, false];
            }else{
                throw new Error('Round already played');
            }
        }else{
            throw new Error('Round not initialized');
        }
    }else{
        throw new Error('Game not initialized');
    }


}
