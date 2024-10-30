import { test, expect } from '@playwright/test';

test('assert search redirect to search page', async ({ page }) => {
  await page.goto('/search');

  await page.getByPlaceholder('Type here').click();
  await page.getByPlaceholder('Type here').fill('bulbasaur');
  
  await page.getByRole('button', { name: 'Search' }).click();
  await expect(page.getByRole('heading')).toContainText('Bulbasaur');
});
