@extends('layouts.app')

@section('title', 'BMI Calculator - Diet Plan System')

@section('styles')
<style>
    .bmi-page-wrapper {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .bmi-calculator {
        display: grid;
        gap: 24px;
        background: radial-gradient(circle at top, rgba(60, 96, 80, 0.4), rgba(21, 36, 24, 0.85));
        border-radius: 26px;
        padding: 30px;
        color: #f3fbf1;
        box-shadow: 0 28px 48px rgba(16, 32, 24, 0.4);
        border: 1px solid rgba(79, 138, 62, 0.24);
    }

    .bmi-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
    }

    .bmi-header h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #f3fbf1;
    }

    .bmi-header p {
        color: rgba(241, 255, 237, 0.9);
        max-width: 500px;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .bmi-unit-toggle {
        display: inline-flex;
        background: rgba(8, 14, 10, 0.45);
        border-radius: 18px;
        padding: 4px;
    }

    .unit-toggle {
        border: none;
        padding: 8px 18px;
        border-radius: 14px;
        background: transparent;
        color: rgba(243, 251, 241, 0.7);
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .unit-toggle.active {
        background: linear-gradient(135deg, #6fe3a1, #3f7dff);
        color: #09120c;
        box-shadow: 0 12px 24px rgba(111, 227, 161, 0.35);
    }

    .bmi-body {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 24px;
    }

    .bmi-form {
        display: grid;
        gap: 16px;
        background: rgba(12, 24, 16, 0.55);
        border-radius: 22px;
        padding: 22px;
    }

    .bmi-field {
        display: grid;
        gap: 12px;
        margin-bottom: 20px;
    }

    .bmi-field label {
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(243, 251, 241, 0.9);
        margin-bottom: 6px;
        display: block;
    }

    .bmi-input,
    .bmi-select {
        background: rgba(5, 10, 7, 0.55);
        border: 2px solid rgba(111, 227, 161, 0.3);
        border-radius: 12px;
        padding: 16px 18px;
        color: #f3fbf1;
        font-size: 18px;
        transition: all 0.2s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .bmi-input:focus,
    .bmi-select:focus {
        outline: none;
        border-color: #6fe3a1;
        box-shadow: 0 0 0 3px rgba(111, 227, 161, 0.25);
    }

    .bmi-gender {
        display: inline-flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .bmi-gender label {
        padding: 12px 20px;
        border-radius: 12px;
        background: rgba(5, 10, 7, 0.45);
        border: 1px solid transparent;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        color: rgba(243, 251, 241, 0.9);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        text-align: center;
    }

    .bmi-gender input {
        display: none;
    }

    .bmi-gender input:checked + span {
        color: #09120c;
        background: linear-gradient(135deg, #6fe3a1, #3f7dff);
        border-color: rgba(111, 227, 161, 0.5);
        box-shadow: 0 12px 18px rgba(111, 227, 161, 0.3);
    }

    .bmi-range-input {
        display: grid;
        gap: 8px;
    }

    .bmi-range-input input[type="range"] {
        accent-color: #6fe3a1;
        width: 100%;
    }

    .bmi-submit, .bmi-reset {
        padding: 16px 24px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 18px;
        min-width: 160px;
        text-align: center;
        margin: 8px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .bmi-submit {
        background: linear-gradient(135deg, #3f7dff, #6fe3a1);
        color: #09120c;
    }

    .bmi-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 26px rgba(63, 125, 255, 0.35);
    }

    .bmi-buttons {
        display: flex;
        gap: 16px;
        margin: 24px 0;
        justify-content: center;
        flex-wrap: wrap;
    }

    .bmi-reset {
        background: linear-gradient(135deg, #ff6b6b, #ff3d3d);
        color: white;
    }

    .bmi-reset:hover {
        background: linear-gradient(135deg, #ff5252, #ff1a1a);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(255, 77, 77, 0.3);
    }

    .bmi-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(63, 125, 255, 0.3);
    }

    .bmi-results {
        background: rgba(12, 24, 16, 0.55);
        border-radius: 22px;
        padding: 22px;
        display: grid;
        gap: 20px;
    }

    .bmi-score {
        text-align: center;
        display: grid;
        gap: 8px;
    }

    .bmi-score h2 {
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(243, 251, 241, 0.65);
    }

    .bmi-value {
        font-size: 48px;
        font-weight: 700;
    }

    .bmi-status {
        font-weight: 600;
        font-size: 16px;
    }

    .bmi-status.normal { color: #6fe3a1; }
    .bmi-status.underweight { color: #6bc4ff; }
    .bmi-status.overweight { color: #f7c948; }
    .bmi-status.obese { color: #ff7b7b; }

    .bmi-scale {
        position: relative;
        height: 12px;
        border-radius: 999px;
        background: linear-gradient(90deg, #6bc4ff, #6fe3a1, #f7c948, #ff7b7b);
        margin-top: 10px;
    }

    .bmi-indicator {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.35);
    }

    .bmi-meta {
        display: grid;
        gap: 12px;
        font-size: 13px;
        color: rgba(243, 251, 241, 0.78);
    }

    .bmi-meta-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .bmi-meta-label {
        color: rgba(243, 251, 241, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
    }

    @media (max-width: 768px) {
        .bmi-body {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="bmi-page-wrapper">
    <div class="bmi-calculator">
        <div class="bmi-header">
            <div>
                <h1>BMI Calculator</h1>
                <p>Quickly check your Body Mass Index and suggested healthy weight range using metric or imperial units.</p>
            </div>
            <div class="bmi-unit-toggle">
                <button type="button" class="unit-toggle active" data-unit="metric">Metric units</button>
                <button type="button" class="unit-toggle" data-unit="imperial">Imperial units</button>
            </div>
        </div>

        <div class="bmi-body">
            <form class="bmi-form" id="bmiForm">
                <div class="bmi-field">
                    <label for="bmiAge">Age</label>
                    <input type="number" id="bmiAge" class="bmi-input" name="age" min="2" max="120" value="30" required>
                </div>
                <div class="bmi-field">
                    <label>Gender</label>
                    <div class="bmi-gender">
                        <label>
                            <input type="radio" name="gender" value="male" checked>
                            <span>Male</span>
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female">
                            <span>Female</span>
                        </label>
                    </div>
                </div>
                <div class="bmi-field">
                    <label for="bmiHeight">Height <span id="heightUnitLabel">(cm)</span></label>
                    <input type="number" id="bmiHeight" class="bmi-input" name="height" min="50" max="260" value="170" required>
                </div>
                <div class="bmi-field">
                    <label for="bmiWeight">Weight <span id="weightUnitLabel">(kg)</span></label>
                    <input type="number" id="bmiWeight" class="bmi-input" name="weight" min="10" max="250" value="65" required>
                </div>
                <div class="bmi-buttons">
                    <button type="submit" class="bmi-submit">Calculate BMI</button>
                    <button type="reset" class="bmi-reset">Reset</button>
                </div>
            </form>

            <div class="bmi-results">
                <div class="bmi-score">
                    <h2>Your BMI</h2>
                    <div class="bmi-value" id="bmiValue">--</div>
                    <div class="bmi-status" id="bmiStatus">Awaiting input</div>
                    <div class="bmi-scale">
                        <div class="bmi-indicator" id="bmiIndicator" style="left: 0%;"></div>
                    </div>
                </div>
                <div class="bmi-meta">
                    <div class="bmi-meta-row">
                        <div>
                            <div class="bmi-meta-label">BMI</div>
                            <span id="bmiDetail">--</span>
                        </div>
                        <div>
                            <div class="bmi-meta-label">Healthy BMI range</div>
                            <span>18.5 - 24.9</span>
                        </div>
                    </div>
                    <div class="bmi-meta-row">
                        <div>
                            <div class="bmi-meta-label">Healthy weight</div>
                            <span id="healthyWeight">--</span>
                        </div>
                        <div>
                            <div class="bmi-meta-label">BMI Prime</div>
                            <span id="bmiPrime">--</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('bmiForm');
        const bmiValue = document.getElementById('bmiValue');
        const bmiStatus = document.getElementById('bmiStatus');
        const bmiDetail = document.getElementById('bmiDetail');
        const bmiIndicator = document.getElementById('bmiIndicator');
        const healthyWeight = document.getElementById('healthyWeight');
        const bmiPrime = document.getElementById('bmiPrime');
        const weightInput = document.getElementById('bmiWeight');
        const heightInput = document.getElementById('bmiHeight');
        const unitButtons = Array.from(document.querySelectorAll('.unit-toggle'));
        const heightUnitLabel = document.getElementById('heightUnitLabel');
        const weightUnitLabel = document.getElementById('weightUnitLabel');

        let unit = 'metric';

        unitButtons.forEach((button) => {
            button.addEventListener('click', () => {
                if (button.dataset.unit === unit) {
                    return;
                }

                unit = button.dataset.unit;
                unitButtons.forEach((btn) => btn.classList.toggle('active', btn === button));

                if (unit === 'metric') {
                    heightUnitLabel.textContent = '(cm)';
                    weightUnitLabel.textContent = '(kg)';
                    heightInput.min = 50;
                    heightInput.max = 260;
                    weightInput.min = 10;
                    weightInput.max = 250;
                } else {
                    heightUnitLabel.textContent = '(inches)';
                    weightUnitLabel.textContent = '(lbs)';
                    heightInput.min = 20;
                    heightInput.max = 100;
                    weightInput.min = 22;
                    weightInput.max = 550;
                }

                calculateBMI();
            });
        });

        // Reset form function
        function resetForm() {
            // Reset all form inputs
            form.reset();
            
            // Reset BMI results display
            bmiValue.textContent = '--';
            bmiStatus.textContent = 'Enter your details';
            bmiStatus.className = 'bmi-status';
            bmiDetail.textContent = '--';
            healthyWeight.textContent = '--';
            bmiPrime.textContent = '--';
            bmiIndicator.style.left = '0%';
            
            // Reset unit toggles
            unit = 'metric';
            unitButtons.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.unit === 'metric');
            });
            
            // Reset labels and input constraints for metric system
            heightUnitLabel.textContent = '(cm)';
            weightUnitLabel.textContent = '(kg)';
            
            // Reset input constraints
            heightInput.min = 50;
            heightInput.max = 260;
            weightInput.min = 10;
            weightInput.max = 250;
            
            // Clear any custom values that might be set programmatically
            heightInput.value = '';
            weightInput.value = '';
            document.querySelector('input[name="gender"]:checked')?.removeAttribute('checked');
            document.querySelector('input[name="gender"][value="male"]').checked = true;
            weightInput.min = 10;
            weightInput.max = 250;
        }

        // Calculate button click handler
        const calculateButton = form.querySelector('.bmi-submit');
        calculateButton.addEventListener('click', (event) => {
            event.preventDefault();
            calculateBMI();
        });

        // Form submit handler
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            calculateBMI();
        });

        // Reset button handler
        const resetButton = form.querySelector('button[type="reset"]');
        resetButton.addEventListener('click', (event) => {
            event.preventDefault();
            resetForm();
        });

        function calculateBMI() {
            const heightRaw = parseFloat(heightInput.value);
            const weightRaw = parseFloat(weightInput.value);

            if (!heightRaw || !weightRaw || heightRaw <= 0 || weightRaw <= 0) {
                bmiValue.textContent = '--';
                bmiStatus.textContent = 'Please enter valid values';
                bmiStatus.className = 'bmi-status';
                bmiDetail.textContent = '--';
                healthyWeight.textContent = '--';
                bmiPrime.textContent = '--';
                bmiIndicator.style.left = '0%';
                return;
            }

            let heightMeters;
            let weightKg;

            if (unit === 'metric') {
                heightMeters = heightRaw / 100;
                weightKg = weightRaw;
            } else {
                heightMeters = heightRaw * 0.0254;
                weightKg = weightRaw * 0.453592;
            }

            const bmi = weightKg / (heightMeters * heightMeters);
            const bmiRounded = Math.round(bmi * 10) / 10;
            const bmiPrimeValue = Math.round((bmi / 25) * 100) / 100;

            bmiValue.textContent = bmiRounded.toFixed(1);
            bmiDetail.textContent = `${bmiRounded.toFixed(1)} kg/m²`;
            bmiPrime.textContent = bmiPrimeValue.toFixed(2);

            const minHealthyWeight = 18.5 * (heightMeters * heightMeters);
            const maxHealthyWeight = 24.9 * (heightMeters * heightMeters);
            const formatWeight = (kg) => {
                if (unit === 'metric') {
                    return `${kg.toFixed(1)} kg`;
                }

                return `${(kg * 2.20462).toFixed(1)} lbs`;
            };

            healthyWeight.textContent = `${formatWeight(minHealthyWeight)} - ${formatWeight(maxHealthyWeight)}`;

            let status = 'Normal';
            let statusClass = 'normal';

            if (bmiRounded < 18.5) {
                status = 'Underweight';
                statusClass = 'underweight';
            } else if (bmiRounded >= 25 && bmiRounded < 30) {
                status = 'Overweight';
                statusClass = 'overweight';
            } else if (bmiRounded >= 30) {
                status = 'Obesity';
                statusClass = 'obese';
            }

            bmiStatus.textContent = status;
            bmiStatus.className = `bmi-status ${statusClass}`;

            // Calculate indicator position on BMI scale (0-40 range)
            // Scale: Underweight (0-18.5), Normal (18.5-25), Overweight (25-30), Obese (30-40)
            let indicatorPosition;
            if (bmiRounded < 18.5) {
                // Underweight: 0-18.5 maps to 0-46.25% of scale
                indicatorPosition = (bmiRounded / 18.5) * 46.25;
            } else if (bmiRounded < 25) {
                // Normal: 18.5-25 maps to 46.25-62.5% of scale
                indicatorPosition = 46.25 + ((bmiRounded - 18.5) / 6.5) * 16.25;
            } else if (bmiRounded < 30) {
                // Overweight: 25-30 maps to 62.5-75% of scale
                indicatorPosition = 62.5 + ((bmiRounded - 25) / 5) * 12.5;
            } else {
                // Obese: 30-40 maps to 75-100% of scale
                indicatorPosition = 75 + ((Math.min(bmiRounded, 40) - 30) / 10) * 25;
            }
            
            indicatorPosition = Math.min(Math.max(indicatorPosition, 0), 100);
            bmiIndicator.style.left = `${indicatorPosition}%`;
        }

        // Initialize with empty values
        resetForm();
    });
</script>
@endsection
