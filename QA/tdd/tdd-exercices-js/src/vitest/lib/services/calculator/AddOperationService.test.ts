import AddOperationService from '$lib/services/calculator/AddOperationService';
import { describe, it, expect } from 'vitest';

describe('AddOperationService test', () => {

    it('getValue with positive operands', () => {

        const addOperationService: AddOperationService = new AddOperationService(1, 2)
        const result = addOperationService.getValue()
        expect(result).toBe(3) 
    })

    it('getValue with negative operands', () => {

        const addOperationService: AddOperationService = new AddOperationService(-1, -2)
        const result = addOperationService.getValue()
        expect(result).toBe(-3) 
    })

    it('getValue with positive and negative', () => {

        const addOperationService: AddOperationService = new AddOperationService(1, -2)
        const result = addOperationService.getValue()
        expect(result).toBe(-1) 
    })
})