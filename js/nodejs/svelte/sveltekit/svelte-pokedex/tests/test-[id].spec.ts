import { test, expect } from '@playwright/test';

test('assert invalid pokemon error is displayed', async ({ page }) => {
  await page.goto('/invalid');
  await page.getByText("Ce pokemon n'existe pas")

  
  // Recording...
});

test('assert valid pokemon infos are displayed', async ({ page }) => {
  await page.goto('/Bulbasaur');
  await page.getAttribute('h1', 'Bulbasaur')
  await page.getAttribute('span#type-1', 'grass')
  await page.getAttribute('li#ability-1', 'overgrow')

  // Recording...
});